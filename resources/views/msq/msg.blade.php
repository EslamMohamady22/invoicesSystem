 @if ($errors->any())
     {{-- <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div> --}}
     <script>
         window.onload = function() {
             notif({
                 'msg': "هناك اخطاء",
                 type: 'Error'
             })
         }
     </script>
 @endif
 @if (session()->has('Error'))
     <div class="alert alert-danger">
         <ul>

             <strong>{{ session()->get('Error') }}</strong>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>

         </ul>
     </div>
 @endif
 @if (session()->has('add'))
     <script type="text/javascript">
         window.onload = function() {

             notif({
                 'msg': 'تم الأضافة بنجاح',
                 type: 'success'
             })
         }
     </script>
 @endif

 @if (session()->has('edit'))
     {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> --}}
     <script>
         window.onload = function() {
             notif({
                 'msg': "تم التعديل بنجاح",
                 type: 'primary'
             })
         }
     </script>
 @endif
 @if (session()->has('delete'))
     <script>
         window.onload = function() {
             notif({
                 'msg': "تم الحذف بنجاح",
                 type: 'warning'
             })
         }
     </script>
 @endif
 @if (session()->has('archive'))
    <script>
        window.onload = function() {
            notif({
                'msg': 'تم  الأرشفة بنجاح',
                type: 'warning'
            })
        }
    </script>
 @endif
 @if (session()->has('restore_invoice'))
    <script>
        window.onload = function() {
            notif({
                'msg': 'تم استرجاع الفاتورة المؤرشفة بنجاح',
                type: 'success'
            })
        }
    </script>
 @endif
