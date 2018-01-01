
@extends('/app')
@section('content')
    <div class="form-group row">
        <div class="col-md-12">
            <h1><a href="https://laravel.com/" target="_blank">Laravel</a> & <a href="https://vuejs.org/" target="_blank">Vue.js 2</a> 記事本</h1>
            <h2>其他使用: <a href="https://jquery.com/" target="_blank">jQuery</a>、<a href="http://getbootstrap.com/" target="_blank">Bootstrap</a>、<a href="http://codeseven.github.io/toastr/demo.html" target="_blank">toastr</a>、<a href="http://fontawesome.io/" target="_blank">Font awesome</a> </h2>
        </div>
        <div class="col-md-12">
            <button type="button" data-toggle="modal" data-target="#create-note" class="btn btn-primary">
                新增記事
            </button>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless">
                <tr>
                    <th>標題</th>
                    <th>內容</th>
                    <th>動作</th>
                </tr>
                <tr v-for="note in notes">
                    <td>@{{ note.title }}</td>
                    <td>@{{ note.content }}</td>
                    <td>
                        <button class="edit-modal btn btn-warning" @click.prevent="editnote(note)">
                            <span class="glyphicon glyphicon-edit"></span> 修改
                        </button>
                        <button class="edit-modal btn btn-danger" @click.prevent="deletenote(note)">
                            <span class="glyphicon glyphicon-trash"></span> 刪除
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <nav>
        <ul class="pagination">
            <li v-if="pagination.current_page > 1">
                <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                <a href="#" @click.prevent="changePage(page)">
                    @{{ page }}
                </a>
            </li>
            <li v-if="pagination.current_page < pagination.last_page">
                <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- 新增對話框 -->
    <div class="modal fade" id="create-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">新增記事</h4>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createnote">
                        <div class="form-group">
                            <label for="title">標題:</label>
                            <input type="text" name="title" class="form-control" v-model="newnote.title" />
                            <span v-if="formErrors['title']" class="error text-danger">
                                @{{ formErrors['title'] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="title">內容:</label>
                            <textarea name="content" class="form-control" v-model="newnote.content">
                            </textarea>
                            <span v-if="formErrors['content']" class="error text-danger">
                                @{{ formErrors['content'] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">儲存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 修改對話框 -->
    <div class="modal fade" id="edit-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">修改記事</h4>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updatenote(fillnote.id)">
                        <div class="form-group">
                            <label for="title">標題:</label>
                            <input type="text" name="title" class="form-control" v-model="fillnote.title" />
                            <span v-if="formErrorsUpdate['title']" class="error text-danger">
                                @{{ formErrorsUpdate['title'] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="title">內容:</label>
                            <textarea name="content" class="form-control" v-model="fillnote.content">
                            </textarea>
                            <span v-if="formErrorsUpdate['content']" class="error text-danger">
                                @{{ formErrorsUpdate['content'] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">儲存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop