
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Chart with Data from ChartModel</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Bar Chart with Data from ChartModel</h1>

    <form action="{{ url('/bar-chart') }}" method="get">
        <label for="selected_month">Select Month:</label>
        <select id="selected_month" name="selected_month">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" @if($selectedMonth == $i) selected @endif>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
            @endfor
        </select>

        <label for="selected_year">Select Year:</label>
        <select id="selected_year" name="selected_year">
            @for ($year = date('Y') - 5; $year <= date('Y') + 5; $year++)
                <option value="{{ $year }}" @if($selectedYear == $year) selected @endif>{{ $year }}</option>
            @endfor
        </select>

        <button type="submit">Filter</button>
    </form>

    <div>
        <canvas id="myChart" width="200" height="80"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: '{{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }} ',
                    data: {!! json_encode($values) !!},
                    backgroundColor: 'rgba(50, 147, 244, 210)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
            }
        },
        layout: {
            padding: {
                left: 50,
                right: 50,
                top: 0,
                bottom: 0
            }
        },
        barPercentage: 0.8, // Adjust this value to control the width of each bar
        categoryPercentage: 0.3, // Adjust this value to control the width of each category group
    }
        });
    </script>
</body>
</html>
