<form id="form_roles" role="form" class="form-horizontal">
       <div class="form-group">
           <label for="txt_name" class="control-label col-sm-2">Nombre </label>
           <div class="col-sm-8">
               <input type="text" id="txt_name" class="form-control" placeholder="nombre">
           </div>
       </div>
       <div class="form-group">
           <label for="txt_slug" class="control-label col-sm-2">Slug</label>
           <div class="col-sm-8">
               <input type="text" id="txt_slug" class="form-control" placeholder="slug">
           </div>
       </div>
       <div class="form-group">
          <label for="txt_descripcion" class="control-label col-sm-2">Descripcion</label>
          <div class="col-sm-8">
              <textarea id="txt_descripcion" class="form-control" rows="5" style="resize: none" placeholder="descripcion"></textarea>
          </div>
       </div>
       <div class="form-group">
           <label for="sel_special" class="control-label col-sm-2">Special</label>
           <div class="col-sm-6">
               <select  id="sel_special" class="form-control">
                   <option value="">select</option>
                   <option value="all-access">Acceso Total</option>
                   <option value="no-access">No Acceso</option>
               </select>
           </div>
       </div>
</form>
