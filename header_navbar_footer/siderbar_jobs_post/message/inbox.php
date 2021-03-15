                 <div class="card card-primary card-outline borders-tops">
                     <div class="card-header">
                         <h3 class="card-title">Inbox</h3>

                         <div class="card-tools">
                             <div class="input-group input-group-sm">
                                 <input type="text" class="form-control" placeholder="Search Mail">
                                 <div class="input-group-append">
                                     <div class="btn btn-primary">
                                         <i class="fa fa-search"></i>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!-- /.card-tools -->
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body p-0">
                    <!-- <script>
                        $('input[type="checkbox"]').on('change', function() {
                            $('input[type="checkbox"]').not(this).prop('checked', false).attr('name','').attr('value','');
                            $(this).prop('checked', true);
                        });
                    </script> -->

                         <div class="mailbox-controls">
                             <!-- Check all button -->
                             <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                     class="fa fa-square-o"></i>
                             </button>
                             <div class="btn-group">
                                 <button type="button" class="btn btn-default btn-sm alldeleteinbox" ><i
                                         class="fa fa-trash-o"></i></button>
                                 <button type="button" class="btn btn-default btn-sm"><i
                                         class="fa fa-reply"></i></button>
                                 <button type="button" class="btn btn-default btn-sm"><i
                                         class="fa fa-share"></i></button>
                             </div>
                             <!-- /.btn-group -->
                             <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                             <div class="float-right">
                                 1-50/200
                                 <div class="btn-group">
                                     <button type="button" class="btn btn-default btn-sm"><i
                                             class="fa fa-chevron-left"></i></button>
                                     <button type="button" class="btn btn-default btn-sm"><i
                                             class="fa fa-chevron-right"></i></button>
                                 </div>
                                 <!-- /.btn-group -->
                             </div>
                             <!-- /.float-right -->
                         </div>
                         <div class="table-responsive mailbox-messages">
                            <form id="form-delete-all" method="post">
                             <table class="table table-hover table-striped">
                                 <thead class="main-active">
                                     <tr>
                                         <td>check</td>
                                         <td>star</td>
                                         <td>Name</td>
                                         <td>Message</td>
                                         <td>File</td>
                                         <td>Time Apply</td>
                                     </tr>
                                 </thead>
                                 <tbody>
                                    <tr><span id="responseSubmitalldelete"></span></tr>
                                    <tr><input type="hidden" name="deleteCheck" value="deleteCheck" ></tr>
                                    <?php echo $job->inbox($_SESSION['key'],$emailFrom=$_SESSION['email']) ; ?>
                                     <!-- <tr>
                                         <td><input type="checkbox"></td>
                                         <td class="mailbox-star"><a href="#"><i
                                                     class="fa fa-star-o text-warning"></i></a></td>
                                         <td class="mailbox-name"><a href="read-mail.html" data-toggle="modal"
                                          data-target="#myModalReady">Alexander Pierce</a></td>
                                         <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a
                                             solution to this problem...
                                         </td>
                                         <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                         <td class="mailbox-date">28 mins ago</td>
                                     </tr> -->
                                 </tbody>
                             </table>
                             <!-- /.table -->
                        </form>
                         </div>
                         <!-- /.mail-box-messages -->
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer p-0">
                         <div class="mailbox-controls">
                             <!-- Check all button -->
                             <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                     class="fa fa-square-o"></i>
                             </button>
                             <div class="btn-group">
                                 <button type="button" class="btn btn-default btn-sm"><i
                                         class="fa fa-trash-o"></i></button>
                                 <button type="button" class="btn btn-default btn-sm"><i
                                         class="fa fa-reply"></i></button>
                                 <button type="button" class="btn btn-default btn-sm"><i
                                         class="fa fa-share"></i></button>
                             </div>
                             <!-- /.btn-group -->
                             <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                             <div class="float-right">
                                 1-50/200
                                 <div class="btn-group">
                                     <button type="button" class="btn btn-default btn-sm"><i
                                             class="fa fa-chevron-left"></i></button>
                                     <button type="button" class="btn btn-default btn-sm"><i
                                             class="fa fa-chevron-right"></i></button>
                                 </div>
                                 <!-- /.btn-group -->
                             </div>
                             <!-- /.float-right -->
                         </div>
                     </div>
                 </div>
                 <!-- /. box -->
            