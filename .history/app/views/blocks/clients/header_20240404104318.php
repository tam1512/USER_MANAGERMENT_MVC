<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>{{$title}}</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="{{_WEB_HOST_ROOT}}/public/assets/clients/css/style.css">
</head>
<body>
   <div class="container-fluid">
      <header>
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a href="{{_WEB_HOST_ROOT}}" class="navbar-brand">USER MANANGER</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
               <span class="navbar-toggle-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                     <a href="{{_WEB_HOST_ROOT}}" class="nav-link">Trang chủ</a>
                  </li>
                  <li class="nav-item">
                     <a href="{{_WEB_HOST_ROOT}}/nguoi-dung" class="nav-link">Người dùng</a>
                  </li>
               </ul>
               <form action="">
                  <div class="form-inline my-2 my-lg-0">
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                        <div class="input-group-append">
                           <button class="btn btn-secondary" type="submit">
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </nav>
      </header>
      <main class="py-3">
      