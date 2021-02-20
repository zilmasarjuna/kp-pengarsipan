<div class="container">
  <form 
    action="<?= BASEURL; ?>/tasks/export" 
    method="post" 
    class="form1"
    target="_blank"
  >
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="from_date">Dari</label>
          <input 
            class="form-control" 
            name="from_date" 
            type="date" 
            id="from_date" 
          />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="from_date">Sampai</label>
          <input 
            class="form-control" 
            name="to_date" 
            type="date" 
            id="from_date" 
          />
        </div>
      </div>

      <div class="col-md-4">
        <button type="submit" class="btn btn-primary">Cetak</button>
      </div>
    </div>
  </form>
</div>