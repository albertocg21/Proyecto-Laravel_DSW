# API Testing Script - Simple Test
# This PowerShell script tests basic API endpoint

$baseUrl = "http://localhost:8000/api/v1"

Write-Host "Testing GET /api/v1/reservas" -ForegroundColor Cyan

try {
    $response = Invoke-RestMethod -Uri "$baseUrl/reservas" -Method GET -Headers @{
        "Accept" = "application/json"
    }
    Write-Host "Success! Status: 200 OK" -ForegroundColor Green
    Write-Host "Total reservas: $($response.meta.total)" -ForegroundColor Gray
} catch {
    Write-Host "Error: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "Status Code: $($_.Exception.Response.StatusCode.value__)" -ForegroundColor Red
}
