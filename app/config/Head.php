<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Dashboard | CRM Millenium </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">
        <!-- toastr -->        
        <link rel="stylesheet" type="text/css" href="../assets/libs/toastr/build/toastr.min.css">
        <!-- DataTables -->
        <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css -->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <script src="../assets/libs/jquery/jquery.min.js"></script>
        <!-- Input file-->
        
    </head>

    <body data-topbar="dark" data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header" style="max-width:95%;">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                           

                            <a href="#" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../assets/images/logo-sm-light.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/images/logo-light.png" alt="" height="20">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item" data-toggle="collapse" data-target="#topnav-menu-content">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>

                        
                        

                       
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ml-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-search-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-search-dropdown">
                    
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        

                        <div class="dropdown d-none d-lg-inline-block ml-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="ri-fullscreen-line"></i>
                            </button>
                        </div>

                        <!--<div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-notification-3-line"></i>
                                <span class="noti-dot"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notificaciones </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small"> Ver todo</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Nueva Notificaci&oacute;n</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                             
                                

                               
                                </div>
                                <div class="p-2 border-top">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                                    </a>
                                </div>
                            </div>
                        </div>-->

                        <div class="dropdown d-inline-block user-dropdown">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="../assets/images/users/avatar-2.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ml-1"><?=$nomtit;?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->                          
                                <a class="dropdown-item" href="#M_Perfil" data-toggle="modal"><i class="ri-user-line align-middle mr-1"></i> Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="../functions/Salir.php"><i class="ri-shut-down-line align-middle mr-1 text-danger"></i> Salir</a>
                            </div>
                        </div>

           
            
                    </div>
                </div>
            </header>
    
                <div class="topnav bg-secondary">
                    <div class="container-fluid" style="max-width:95%;">
                        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
    
                            <div class="collapse navbar-collapse" id="topnav-menu-content">
                                <ul class="navbar-nav">

                                    <li class="nav-item ">
                                        <a class="nav-link text-white" href="HvaDdWDXGSnWNgkMBuArumVH5gdUftDFWb8E">
                                            <i class="ri-home-gear-line mr-2"></i> Incio
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none text-white" href="#" id="topnav-layout" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-calendar-event-fill mr-2"></i>Boletas Visita <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnav-layout">
                                            <a href="#" class="dropdown-item">Ver Boletas </a>  
                                            <div class="dropdown-divider"></div>
                                            <a href="NrB2EmrgRPkeJ8UKofJAV6dhQ8zjyqEnYEkn" class="dropdown-item">Clientes</a>
                                            <a href="5GJ4Nm5oEEd3RKvrobCiRFt2dsYhdxEM53iD" class="dropdown-item">Equipos</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none text-white" href="#" id="topnav-layout" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-stack-line mr-2"></i>Boletas  Remoto<div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnav-layout">
                                            <a class="dropdown-item" href="#M_Interna" data-toggle="modal"> Internas  </a>  
                                            <a href="eFJLH4QB8NA8qpQtyn8AnHEtnMgZuijsbfGz" class="dropdown-item">Ver Boletas </a>  
                                            <div class="dropdown-divider"></div>
                                            <a href="pAGkUcEfFgweLTdmA6iE4YzvYeMGBMBBx5yo" class="dropdown-item">Remitentes </a>  
                                          
                                        </div>
                                    </li>
                                   
                                    <li class="nav-item ">
                                        <a class="nav-link text-white" href="U3WG3HwDihrcGRGNCnjiHaRqNxjtPkATKXkb">
                                            <i class="ri-team-line mr-2"></i> Cotizaciones
                                        </a>
                                    </li> 

                             
                                    
                                 
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none text-white" href="#" id="topnav-layout" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-layout-3-line mr-2"></i>Reportes <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnav-layout">
                                            <a href="MGZDARAUV6tG3yDAFbJV6S7TcR84qY2tvazG" class="dropdown-item">Boletas </a>
                                            <a href="cKi2cpSq2tSwMAwPgr5STXyxSGnc4C2ju6ny" class="dropdown-item">Clientes </a>
                                            <!--<a href="#" class="dropdown-item">Tecnicos </a>-->
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none text-white" href="#" id="topnav-more" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class=" ri-asterisk mr-2"></i>Configuraci&oacute;n <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-more">
                                            <div class="dropdown">
                                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Sistema <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                                    <a href="WCgjTHpiFp4K3cAGsHQatToMzYexVznaAfmG" class="dropdown-item">General</a>
                                                    
                                                    <a href="UensYuNFd6h5T7neGFJsJpMBxxDEscJ8vDZz" class="dropdown-item">Bitacora</a>
                                                  
                                                    <a href="HREJkBcWG28tyszQTZFgRLWqk7GSjp6yzG6L" class="dropdown-item">Usuarios</a>
                                                    <!--<a href="#" class="dropdown-item">Modulos </a>
                                                    <a href="#" class="dropdown-item">Permisos</a>-->
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Boletas <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                                    <a href="YymLxK78WsHPBWFZwtkXxVpqVuipxP53NSNf" class="dropdown-item">Tipo</a>
                                                    <a href="nRGkZk7QpdpEwvSwwg9wMwHG48TP75BHpfP4" class="dropdown-item">Categorias</a>
                                                    <!--<a href="#" class="dropdown-item">Estatus</a>
                                                    -->
                                                    <!--<div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item">Personal <small>Tecnicos</small></a>
                                                    -->
                                                </div>
                                            </div>
                                        </div>
                                    </li>
    
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
