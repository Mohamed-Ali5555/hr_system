<!DOCTYPE html>
<html lang="en" class="loading">
   <head>
         @include('backend.layouts.head')

   </head>
   <body data-col="2-columns" class=" 2-columns ">
      <div class="wrapper">
                @include('backend.layouts.sidebar')

                @include('backend.layouts.nav')

        
          @yield('content')

      </div>
                         @include('backend.layouts.sidebar_background')

     
                   @include('backend.layouts.footer')



   </body>
</html>


<script>
    setInterval(function() {
        $("#notifications_count").load(window.location.href + " #notifications_count");
        $("#unreadNotifications").load(window.location.href + " #unreadNotifications");
	
    }, 5000);

</script>