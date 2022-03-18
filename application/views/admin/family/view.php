<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?=$title?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?=$title?></strong>
            </li>
        </ol>
    </div> 
    <div class="col-sm-8">
        <div class="title-action">
            <button class="btn btn-primary" id="btn_add">
                <i class="fa fa-users"></i> Tambah baru
            </button> 
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">

                </div>
                <div class="ibox-content">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th width="1"><input type="checkbox" id="AllCheck"></th>  
                                <th width="1"></th>  
                                <th width="1">No</th>  
                                <th width="100">Tanggal</th>  
                                <th>Nama</th>
                                <th width="100">Email</th>
                                <th width="200">Pekerjaan</th> 
                                <th width="1">Status</th> 
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div id="menu_popup" class="pull-left" style='display: none'> 
                                    <button type="button" class="btn btn-primary btn-xs" id="btn_unlock">
                                                <i class="fa fa-unlock"></i> Aktifkan
                                        </button>
                                         <button type="button" class="btn btn-danger btn-xs" id="btn_lock">
                                                <i class="fa fa-lock"></i> Blokir
                                        </button>
                                    </div> 
                                </td>
                            </tr>
                        </tfoot>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</div>