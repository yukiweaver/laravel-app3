<div class="container close" id="notification">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <h3>通知一覧</h3>
        <div class="card-body">
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  let container = document.getElementById('container');
  let notification = document.getElementById('notification');
  document.getElementById('humberger').onclick = function() {
    container.classList.toggle('close');
    notification.classList.toggle('close');
  }
</script>  