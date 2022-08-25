  
  

  
  
  
  
  
  
  
   <script src="{{asset('backend/assets/vendors/js/core/jquery-3.3.1.min.js')}}"></script>
      <script src="{{asset('backend/assets/vendors/js/core/popper.min.js')}}"></script>
      <script src="{{asset('backend/assets/vendors/js/core/bootstrap.min.js')}}"></script>
      <script src="{{asset('backend/assets/vendors/js/perfect-scrollbar.jquery.min.js')}}"></script>
      <script src="{{asset('backend/assets/vendors/js/prism.min.js')}}"></script>
      <script src="{{asset('backend/assets/vendors/js/jquery.matchHeight-min.js')}}"></script>
      <script src="{{asset('backend/assets/vendors/js/screenfull.min.js')}}"></script>
      <script src="{{asset('backend/assets/vendors/js/pace/pace.min.js')}}"></script>
      <script src="{{asset('backend/assets/vendors/js/chartist.min.js')}}"></script>
      <script src="{{asset('backend/assets/js/app-sidebar.js')}}"></script>
      <script src="{{asset('backend/assets/js/notification-sidebar.js')}}"></script>
      <script src="{{asset('backend/assets/js/customizer.js')}}"></script>
      <script src="{{asset('backend/assets/js/dashboard-ecommerce.js')}}"></script>


@yield('scripts')


<script>
setTimeout(function(){
  $('#alert').slideUp();
},4000);

</script>
