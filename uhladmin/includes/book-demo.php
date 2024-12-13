
<!-- Modal -->
<div class="modal fade" id="book-demo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="book-demo-form">
              <form action="/examples/actions/confirmation.php" method="post">
              
                  <div class="form-group">
                    <div class="row">
                      <div class="col"><input type="text" class="form-control" name="firstname" placeholder="First Name"></div>
                      <div class="col"><input type="text" class="form-control" name="lastname" placeholder="Last Name"></div>
                    </div>          
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="example@digitalworkdesk.com" >
                  </div>
                  <div class="form-group">
                      <select class="form-control" name="product" id="product">
                         <option value="">Choose Product</option>
                         <option value="FMS">Facility Management Software</option>
                         <option value="AMS">Admission Management Software</option>
                      </select>
                  </div>
                  <div class="form-group text-center">
                      <button type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>