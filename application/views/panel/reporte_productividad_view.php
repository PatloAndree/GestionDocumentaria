 
  <div class="card">
        <div class="card-body body">
              <div class="row">
                      <div class="col-md-5">
                            <form id="formRservicios">
                                    <div class="row">

                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="estado">Estado :</label>
                                                <i class="ni ni-bold-down text-orange"></i>
                                                <select id="estado" name="estado" class="form-control">
                                                  <option value="">TODOS</option>
                                                  <option value="1">ANULADO</option>
                                                  <option value="2">PENDIENTE</option>
                                                  <option value="3">OBSERVADO</option>
                                                  <option value="4">PROGRAMADO</option>
                                                  <option value="5">ATENDIDO</option>
                                                </select>
                                            </div>
                                          </div>

                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="rangofecha">Rango de fecha</label>
                                                  <input type="text" name="rangofecha" id="rangofecha" class="form-control daterange" />
                                              </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rangofecha"></label>
                                              <button class="btn btn-success" type="button" id="rpgenerar">Generar</button>
                                            </div>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rangofecha"></label>
                                              <button class="btn btn-dark text-white" type="button" id="rpdescargar">Generar</button>    
                                            </div>
                                        </div>
                                    </div>
                            </form>
                      </div>

                   

              <div class="row">
                  <div class="panel-body">
                    <!-- <div id="chart_area" style="width: 1000px; height: 620px;"> -->
                    </div>
                  </div>
              </div>         
        </div>
  </div>

<style>
	.svg-icon {
		display: inline-flex;
		align-self: center
	}

	.svg-icon img,
	.svg-icon svg {
		height: 1em;
		width: 1em;
		fill: currentColor
	}

	.svg-icon.baseline svg,
	.svg-icon img {
		top: .125em;
		position: relative
	}
</style>

