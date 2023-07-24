<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Creacion de Usuario<h2>
            </div>
            <div class="body">
            <form class="form" action="poss">
                <div class="form-group">
                    <label for="usuario-nombre">Ingrese sus nombres</label>
                    <input type="text" class="form-control" name="usuario-nombre">
                </div>
                <div class="form-group">
                    <label for="usuario-apellidos">Ingrese sus apellidos</label>
                    <input type="text" class="form-control" name="usuario-apellidos">
                </div>
                <div class="form-group">
                   <label for="usuario-documento">Selecciona documento</label>
                   <select name="usuario-documento" id="usuario-documento" class="form-control">
                       <option value="dni">DNI</option>
                       <option value="ruc">RUC</option>
                   </select>
                </div>
                <div class="form-group">
                    <label for="usuario-genero">Seleccionar genero</label><br>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="usuario-genero">Masculino
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="usuario-genero">Femenino
                        </label>
                    </div>
                    <div class="form-check-inline ">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="usuario-genero">prefiero no decirlo
                        </label>
                    </div>
                </div>
          </div> 
            <div class="card-footer text-right">
                    <button class="btn btn-lg btn-success">agregar 
                    </button>                
            </div>
             </form>
          </div>
    </div>
</div>

                