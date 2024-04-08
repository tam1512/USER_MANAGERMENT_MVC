
      </main>
      <footer>
         <p class="text-center">{{$copyright}}</p>
      </footer>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
      let root = "{{_WEB_HOST_ROOT}}";
      let msg = "{!!empty($message) ? $message : ''!}"
      let msgType = "{{!empty($msg_type) ? $msg_type : ''}}"

      if(msg && msgType) {
         Swal.fire({
            title: "Thông báo!!",
            text: msg,
            icon: msgType
         })
      }

   </script>
   <script src="{{_WEB_HOST_ROOT}}/public/assets/clients/js/app.js?ver={{rand()}}"></script>
</body>
</html>