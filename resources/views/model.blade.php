<div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update Status')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample" method="POST" action="/users/status">
                    @csrf
                    <input type="hidden" name="id" id="stid">
                    <input type="hidden" name="status" id="st">

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Reason')}}</label>
                        <div class="col-sm-9">
                            <textarea name="reason" class="form-control border-dark" cols="40" rows="3"></textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="rewards" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update Status')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample" method="POST" action="/request/update">
                    @csrf

                    <input type="hidden" name="id" id="request_id">

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Type')}}</label>
                        <div class="col-sm-9">
                            <select name="type" class="form-control border-dark">
                                <option value="Success">Success</option>
                                <option value="Reject">Reject</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Remark')}}</label>
                        <div class="col-sm-9">
                            <textarea name="reason" class="form-control border-dark" cols="10" rows="3" placeholder="youl recevie payment with in 2 days"></textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Add Promotion Banner-->
<div class="modal fade" id="bannermodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Banner Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample" method="POST" action="/banner/create" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Banner onClick Action')}}</label>
                        <div class="col-sm-12">
                            <select name="type" class="form-control" required>
                                <option value="spin">Spin Screen</option>
                                <option value="video">Video Task Screen</option>
                                <option value="web">Website Task Screen</option>
                                <option value="link">Link</option>
                                <option value="refer">Referral Screen</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Url( Required only for Banner Action Link)</label>
                        <div class="col-sm-12">
                            <input type="text" name="link" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Select Banner (200*400)</label>
                        <div class="col-sm-12">
                            <input type="file" name="icon" class="form-control" />
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Add')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!---update promotion banner-->
<div class="modal fade modal" id="updatebanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Banner Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample-banner" method="POST" action="/banner/update" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="bannersid" />
                    <input type="hidden" name="oldimage" id="oldimagebanner" />

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Banner onClick Action')}}</label>
                        <div class="col-sm-12">
                            <select name="type" class="form-control" id="type" required>
                                <option value="spin">Spin Screen</option>
                                <option value="video">Video Task Screen</option>
                                <option value="web">Website Task Screen</option>
                                <option value="link">Link</option>
                                <option value="refer">Referral Screen</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Url( Required only for Banner Action Link)</label>
                        <div class="col-sm-12">
                            <input type="text" name="links" id="link" class="form-control" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-12 col-form-label">{{ __('Select Banner 200*400')}}</label>
                        <div class="col-sm-12">
                            <input id="icon" type="file" class="form-control" name="icon" placeholder="Select">
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Add Game-->
<div class="modal fade" id="gamemodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Game Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample" method="POST" action="/games/create" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Title</label>
                        <div class="col-sm-12">
                            <input type="text" name="title" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Short Description</label>
                        <div class="col-sm-12">
                            <input type="text" name="description" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Timer in Minute (how many minute user need to play game )</label>
                        <div class="col-sm-12">
                            <input type="number" name="time" class="form-control"  placeholder="5"  required/>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Coin ( after play game user will get coin)</label>
                        <div class="col-sm-12">
                            <input type="number" name="coin" class="form-control" placeholder="12" required/>
                        </div>
                    </div>

                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Url</label>
                        <div class="col-sm-12">
                            <input type="text" name="link" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Screen Orientation</label>
                        <div class="col-sm-12">
                            <select name="orientation" class="form-control" required>
                                <option value="0">Portrait</option>
                                <option value="1">LandScape</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Play Game in</label>
                        <div class="col-sm-12">
                            <select name="browser_type" class="form-control" required>
                                <option value="0">In App</option>
                                <option value="1">Chrome Custom Tab</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Thumbnail 200*200</label>
                        <div class="col-sm-12">
                            <input type="file" name="icon" class="form-control" />
                        </div>
                    </div>
                    
                    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Add')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!---update Game-->
<div class="modal fade modal" id="updategame" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Game Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample-banner" method="POST" action="/games/update" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="gid" />
                    <input type="hidden" name="oldimage" id="goldimage" />

                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Title</label>
                        <div class="col-sm-12">
                            <input type="text" id="gtitle" name="title" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Short Description</label>
                        <div class="col-sm-12">
                            <input type="text" name="description" id="gdescription" class="form-control" required/>
                        </div>
                    </div>

                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Timer in Minute (how many minute user need to play game )</label>
                        <div class="col-sm-12">
                            <input type="number" name="time" id="game_time" class="form-control"  placeholder="5"  required/>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Coin ( after play game user will get coin)</label>
                        <div class="col-sm-12">
                            <input type="number" name="coin" id="game_coin" class="form-control" placeholder="12" required/>
                        </div>
                    </div>

                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Url</label>
                        <div class="col-sm-12">
                            <input type="text" name="link" id="game_link" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Screen Orientation</label>
                        <div class="col-sm-12">
                            <select name="orientation" id="game_orientation" class="form-control" required>
                                <option value="0">Portrait</option>
                                <option value="1">LandScape</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Play Game in</label>
                        <div class="col-sm-12">
                            <select name="browser_type" id="game_browser_type" class="form-control" required>
                                <option value="0">In App</option>
                                <option value="1">Chrome Custom Tab</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Game Thumbnail 200*200</label>
                        <div class="col-sm-12">
                            <input type="file" name="icon" class="form-control" />
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Create Admin -->
<div class="modal fade" id="adminmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Create New Admin')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample-banner" method="POST" action="/admins/create">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" name="name" class="form-control" placeholder="John" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" name="email" class="form-control" placeholder="xxx@gmail.com" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Password</label>
                        <div class="col-sm-12">
                            <input type="text" name="password" class="form-control" placeholder="**********" required />
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Create Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_create" class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Edit Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_edit" class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">User See Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_user" class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Delete Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_delete" class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Setting Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_setting" class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Create')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Update Admin -->
<div class="modal fade" id="updateAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update Admin')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample-banner" method="POST" action="/admins/update">
                    @csrf
                    <input type="hidden" name="id" id="adminid"/>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" name="name" id="adminName" class="form-control" placeholder="John" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" name="email" id="adminEmail" class="form-control" placeholder="xxx@gmail.com" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Password</label>
                        <div class="col-sm-12">
                            <input type="text" name="password" id="adminpass" class="form-control" placeholder="**********"  />
                        </div>
                    </div>
                    
                      
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Create Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_create" id="admin_role_create" class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2"  id="admin_role_edit" class="col-sm-12 col-form-label">Edit Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_edit" class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">User See Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_user"  id="admin_role_user" class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Delete Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_delete" id="admin_role_delete" class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Setting Permission</label>
                                <div class="col-sm-12">
                                    <select name="role_setting" id="admin_role_setting"  class="form-control">
                                        <option value="true">true</option>
                                        <option value="false">false</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--add coin to user-->
<div class="modal fade"  id="updateCoinModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update User Coin')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample" method="POST" action="/users/update">
                    @csrf
                    <input type="hidden" name="id" id="coin_user_id">
                    <input type="hidden" name="type" value="update_coin">
                    
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Select Type ')}}</label>
                        <div class="col-sm-12">
                            <select name="coin_type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Coins')}}</label>
                        <div class="col-sm-12">
                            <input type="number" name="coin" class="form-control" placeholder="500" required>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Remark')}}</label>
                        <div class="col-sm-12">
                            <input type="text" name="remark" class="form-control" placeholder="Admin Bonus" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Update Coin')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>




<!--update user profile-->
<div class="modal fade"  id="updateUserModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update User Profile')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample" method="POST" action="/users/update" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="profile_user_id">
                    <input type="hidden" name="oldicon" id="profile_icon">
                    <input type="hidden" name="type" value="profile">
                    
                    
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('User Name')}}</label>
                        <div class="col-sm-12">
                            <input type="text" name="name" class="form-control" placeholder="john" id="profile_username" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Profile Image (200*200)')}}</label>
                        <div class="col-sm-12">
                            <input type="file" name="icon" class="form-control"  >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Phone no.')}}</label>
                        <div class="col-sm-12">
                            <input type="number" name="phone" class="form-control" placeholder="123456789"  id="profile_phone" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Email')}}</label>
                        <div class="col-sm-12">
                            <input type="email" name="email" class="form-control" placeholder="john@gmail.com"  id="profile_email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Password')}}</label>
                        <div class="col-sm-12">
                            <input type="password" name="password" class="form-control" placeholder="****"  id="profile_password"  required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Update Profile')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Add Social Modal-->

<div class="modal fade" id="socialmodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Social Link Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample" method="POST" action="/social-link/create" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group" >
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" name="title" class="form-control" placeholder="Instagram,twitter" required/>
                        </div>
                    </div>
                    
                    <div class="form-group" >
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Url</label>
                        <div class="col-sm-12">
                            <input type="text" name="url" class="form-control" placeholder="http://" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Logo</label>
                        <div class="col-sm-12">
                            <input type="file" name="icon" class="form-control" required/>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Add')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--Update Social Modal-->

<div class="modal fade" id="updatesocialmodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Social Link Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample" method="POST" action="/social-link/update" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="id" id="social_id">
                    <input type="hidden" name="oldicon" id="social_icon">

                    <div class="form-group" >
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" name="title" id="social_title" class="form-control" placeholder="Instagram,twitter" />
                        </div>
                    </div>
                    
                    <div class="form-group" >
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Url</label>
                        <div class="col-sm-12">
                            <input type="text" name="url" id="social_url" class="form-control" placeholder="http://" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Logo</label>
                        <div class="col-sm-12">
                            <input type="file" name="icon" class="form-control" />
                        </div>
                    </div>
                    
                    <select name="status" id="social_status" class="form-control">
                        <option value="0">Active</option>
                        <option value="1">Disable</option>
                    </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="postbackmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Postback Url')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Postback Url')}}</label>
                        <div class="col-sm-12">
                            <textarea id="postback" class="form-control border-dark"  rows="5" readonly></textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!---update language-->
<div class="modal fade modal" id="langmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Language Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample-banner" method="POST" action="/language/update" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="lang_id" />
                    <input type="hidden" name="oldimage" id="lang_oldimage" />

                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Language Name</label>
                        <div class="col-sm-12">
                            <input type="text" name="title" id="lang_name" class="form-control" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-12 col-form-label">{{ __('Select Language Icon 100*100')}}</label>
                        <div class="col-sm-12">
                            <input id="icon" type="file" class="form-control" name="icon" placeholder="Select">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Language Status')}}</label>
                        <div class="col-sm-12">
                            <select name="status" class="form-control" id="lang_status" required>
                                <option value="0">Active</option>
                                <option value="1">Disabled</option>
                            </select>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
