
</div>
  </main>
  
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      // Update the text fields
      document.getElementById('availableUnits').textContent = unitData.availableUnits;
      document.getElementById('totalUnits').textContent = unitData.totalUnits;
      document.getElementById('occupiedUnits').textContent = unitData.occupiedUnits;

      // Create the chart
      const ctx = document.getElementById('unitsChart').getContext('2d');
      new Chart(ctx, {
          type: 'doughnut',
          data: {
              labels: ['Available Units', 'Occupied Units'],
              datasets: [{
                  data: [unitData.availableUnits, unitData.occupiedUnits],
                  backgroundColor: ['#4CAF50', '#f97316']
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      display: false
                  }
              }
          }
      });
  </script>

  <script>
      // Create the chart
      const paymentCtx = document.getElementById('paymentChart').getContext('2d');
      new Chart(paymentCtx, {
        type: 'bar',
        data: {
            labels: paymentData.months,
            datasets: [{
                label: 'Monthly Payment',
                data: paymentData.monthlyPayments,
                backgroundColor: '#f97316'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
      });
  </script>

  <script>
      // Create the semi-circle chart for rent collection
      const ctx2 = document.getElementById('rentCollectionChart').getContext('2d');
      new Chart(ctx2, {
          type: 'bar',
          data: {
              labels: ['Paid', 'Unpaid'],
              datasets: [{
                  data: [collectionData.paidInvoices, collectionData.totalInvoices - collectionData.paidInvoices],
                  backgroundColor: ['#4CAF50', '#f97316']
              }]
          },
          options: {
              responsive: true,
              rotation: -Math.PI,
              circumference: Math.PI,
              plugins: {
                  legend: {
                      display: false
                  }
              }
          }
      });
  </script>
  
  <script>
    $(document).ready( function () {
      $('#myTable').DataTable();
    });
  </script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>

</body>

</html>