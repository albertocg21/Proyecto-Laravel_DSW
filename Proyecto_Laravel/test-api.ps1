# API Testing Script - Quick Verification
# This PowerShell script tests all API endpoints

$baseUrl = "http://localhost/Proyecto-Laravel-AE3.1/Proyecto_Laravel/public/api/v1"
$headers = @{
    "Accept" = "application/json"
    "Content-Type" = "application/json"
}

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "API v1 Testing Script - Reservas" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Test 1: List all reservations
Write-Host "Test 1: GET /api/v1/reservas (List All)" -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/reservas" -Method GET -Headers $headers
    Write-Host "✓ Status: 200 OK" -ForegroundColor Green
    Write-Host "  Total reservas: $($response.meta.total)" -ForegroundColor Gray
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}
Write-Host ""

# Test 2: Create new reservation (Success case)
Write-Host "Test 2: POST /api/v1/reservas (Create - Success)" -ForegroundColor Yellow
$newReserva = @{
    nombre = "API Test User"
    email = "apitest@example.com"
    clase = "Yoga"
    fecha = "2026-03-15"
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$baseUrl/reservas" -Method POST -Headers $headers -Body $newReserva
    Write-Host "✓ Status: 201 Created" -ForegroundColor Green
    Write-Host "  ID: $($response.data.id)" -ForegroundColor Gray
    Write-Host "  Nombre: $($response.data.nombre)" -ForegroundColor Gray
    $createdId = $response.data.id
} catch {
    Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
}
Write-Host ""

# Test 3: Create with validation errors
Write-Host "Test 3: POST /api/v1/reservas (Create - Validation Error)" -ForegroundColor Yellow
$invalidReserva = @{
    nombre = ""
    email = "invalid-email"
    clase = ""
    fecha = "2020-01-01"
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$baseUrl/reservas" -Method POST -Headers $headers -Body $invalidReserva -ErrorAction Stop
    Write-Host "✗ Should have failed validation!" -ForegroundColor Red
} catch {
    if ($_.Exception.Response.StatusCode -eq 422) {
        Write-Host "✓ Status: 422 Unprocessable Entity (Expected)" -ForegroundColor Green
        Write-Host "  Validation working correctly!" -ForegroundColor Gray
    } else {
        Write-Host "✗ Unexpected error: $($_.Exception.Message)" -ForegroundColor Red
    }
}
Write-Host ""

# Test 4: Get single reservation
if ($createdId) {
    Write-Host "Test 4: GET /api/v1/reservas/$createdId (Show)" -ForegroundColor Yellow
    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/reservas/$createdId" -Method GET -Headers $headers
        Write-Host "✓ Status: 200 OK" -ForegroundColor Green
        Write-Host "  Nombre: $($response.data.nombre)" -ForegroundColor Gray
    } catch {
        Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
    }
    Write-Host ""
}

# Test 5: Get non-existent reservation
Write-Host "Test 5: GET /api/v1/reservas/99999 (Not Found)" -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/reservas/99999" -Method GET -Headers $headers -ErrorAction Stop
    Write-Host "✗ Should have returned 404!" -ForegroundColor Red
} catch {
    if ($_.Exception.Response.StatusCode -eq 404) {
        Write-Host "✓ Status: 404 Not Found (Expected)" -ForegroundColor Green
        Write-Host "  Error handling working correctly!" -ForegroundColor Gray
    } else {
        Write-Host "✗ Unexpected error: $($_.Exception.Message)" -ForegroundColor Red
    }
}
Write-Host ""

# Test 6: Update reservation
if ($createdId) {
    Write-Host "Test 6: PUT /api/v1/reservas/$createdId (Update)" -ForegroundColor Yellow
    $updateReserva = @{
        nombre = "Updated Test User"
        email = "updated@example.com"
        clase = "Pilates"
        fecha = "2026-04-20"
    } | ConvertTo-Json

    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/reservas/$createdId" -Method PUT -Headers $headers -Body $updateReserva
        Write-Host "✓ Status: 200 OK" -ForegroundColor Green
        Write-Host "  Nombre actualizado: $($response.data.nombre)" -ForegroundColor Gray
    } catch {
        Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
    }
    Write-Host ""
}

# Test 7: Delete reservation
if ($createdId) {
    Write-Host "Test 7: DELETE /api/v1/reservas/$createdId (Delete)" -ForegroundColor Yellow
    try {
        Invoke-RestMethod -Uri "$baseUrl/reservas/$createdId" -Method DELETE -Headers $headers
        Write-Host "✓ Status: 204 No Content" -ForegroundColor Green
        Write-Host "  Reserva eliminada correctamente!" -ForegroundColor Gray
    } catch {
        Write-Host "✗ Error: $($_.Exception.Message)" -ForegroundColor Red
    }
    Write-Host ""
}

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Testing Complete!" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
