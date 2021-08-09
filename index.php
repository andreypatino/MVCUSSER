
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Usuarios</title>
       <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Usuarios</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            >
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Usuarios</a
                            >
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"></div>                       
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Usuarios</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                       
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Crear Usuarios</div>
                                    <div class="card-body">
                                      <form id="FcrearP">  
                                        <div class="form-group row">
                                          <div class="col-md-6">
                                            <label for="ex1">Nombre:</label>
                                            <input class="form-control" id="Nombre" type="text">
                                          </div>                                          
                                          <div class="col-md-6">                                            
                                            <div id="Slrol"></div>
                                          </div>                                          
                                          <div class="col-md-12">
                                            <label for="ex1">Activo:</label>
                                            <label class="checkbox-inline">
                                              <input type="radio" id="str" name="str" value="1">Si
                                            </label>
                                            <label class="checkbox-inline">
                                              <input type="radio" id="str"  name="str" value="2">No
                                            </label>                                            
                                          </div>
                                        </div>
                                        <button type="button" class="btn btn-success" onclick="saveUs();">Guardar</button>
                                      </form>  
                                    </div>
                                </div>
                            </div> 
                             <!-- Modal -->
                              <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">                                  
                                      <h4 class="modal-title">Actualizar Usuario</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form id="Eusser">
                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="ex1">Nombre:</label>
                                              <input class="form-control" id="Nombree" type="text">
                                              <input class="form-control" type="hidden" id="idusser" type="number">
                                            </div>                                          
                                            <div class="col-md-6">                                            
                                              <div id="Slrole"></div>
                                            </div>                                          
                                            <div class="col-md-12">
                                              <label for="ex1">Activo:</label>
                                              <label class="checkbox-inline">
                                                <input type="radio" id="stre" name="stre" value="1">Si
                                              </label>
                                              <label class="checkbox-inline">
                                                <input type="radio" id="stre"  name="stre" value="2">No
                                              </label>                                            
                                            </div>
                                          </div>
                                          <button type="button" class="btn btn-success" onclick="actualizarUsser();">Guardar</button>
                                       </form> 
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>                           
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Usuarios</div>
                            <div class="card-body">
                                <div class="table-responsive" id='datableproductos'>                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                           
                        </div>
                    </div>
                </footer>
            </div>
            <div class='modal fade' id='myModaltick' role='dialog'>
              <div class='modal-dialog'>                        
                <!-- Modal content-->
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 class='modal-title'></h4>
                  </div>
                  <div class='modal-body'>
                    <p id="Msini"></p>
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                  </div>
                </div>                          
              </div>
            </div>
        </div>
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="js/funciones.js"></script>
    </body>
</html>
