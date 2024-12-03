  <!-- <div id="loader"></div> -->

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="<?php echo URLROOT ?>/shop/public/js/admin-dashboard.js"></script>
  <script src="<?php echo URLROOT; ?>/public/js/filterProduct.js"></script>

  <script>
      // Get the monthly data from PHP and map it to chart labels and revenues
      const monthlyData = <?php echo json_encode($data['monthly']); ?>;

      const monthlyLabels = monthlyData.map(item => item.month);
      const monthlyRevenue = monthlyData.map(item => parseFloat(item.revenue));

      // Monthly Revenue Chart Data
      const monthlyChartData = {
          labels: monthlyLabels,
          datasets: [{
              label: 'Revenue (in ₹)',
              data: monthlyRevenue,
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 2,
              tension: 0.4
          }]
      };


      // Get the year;ly data from PHP and map it to chart labels and revenues
      const yearlyData = <?php echo json_encode($data['yearly']); ?>;
      const yearlyLabels = yearlyData.map(item => item.year);
      const yearlyRevenue = yearlyData.map(item => parseFloat(item.revenue));

      // Yearly Revenue Data (Hardcoded for now)
      const yearlyChartData = {
          labels: yearlyLabels,
          datasets: [{
              label: 'Revenue (in ₹)',
              data: yearlyRevenue,
              backgroundColor: 'rgba(255, 206, 86, 0.2)',
              borderColor: 'rgba(255, 106, 89, 1)',
              borderWidth: 2,
              tension: 0.4
          }]
      };

      // Initialize Monthly Revenue Bar Chart
      new Chart(document.getElementById('monthlyRevenueChart'), {
          type: 'bar',
          data: monthlyChartData,
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top'
                  }
              }
          }
      });

      // Initialize Yearly Revenue Line Chart
      new Chart(document.getElementById('yearlyRevenueChart'), {
          type: 'line',
          data: yearlyChartData,
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top'
                  }
              }
          }
      });


      // Parse sales data from PHP
      const salesData = <?php echo json_encode($data['salesCount']); ?>;

      // Prepare chart labels (months) and data (sales counts)
      const salesLabels = salesData.map(item => item.month);
      const salesCounts = salesData.map(item => parseInt(item.total_sales));

      // Initialize the chart
      const ctx = document.getElementById('salesChart').getContext('2d');
      new Chart(ctx, {
          type: 'line',
          data: {
              labels: salesLabels,
              datasets: [{
                  label: 'Sales',
                  data: salesCounts,
                  borderColor: 'rgba(54, 162, 235, 1)',
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderWidth: 2,
                  tension: 0.4
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top'
                  }
              },
              scales: {
                  x: {
                      title: {
                          display: true,
                          text: 'Months'
                      }
                  },
                  y: {
                      title: {
                          display: true,
                          text: 'Sales Count'
                      },
                      beginAtZero: true
                  }
              }
          }
      });
  </script>

  <!-- DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  </body>

  </html>