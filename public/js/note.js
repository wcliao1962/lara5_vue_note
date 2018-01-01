Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
    el :'#manage-note',
    data :{
        notes: [],
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        formErrors:{},
        formErrorsUpdate:{},
        newnote : {'title':'','content':''},
        fillnote : {'title':'','content':'','id':''}
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },


    mounted: function () {

        this.getVuenote(this.pagination.current_page);
    },
    methods: {
        getVuenote: function(page) {
            this.$http.get('/vuenotes?page='+page).then((response) => {

                this.$set(this,'notes', response.data.data.data);
            this.$set(this,'pagination', response.data.pagination);
        });
        },
        createnote: function() {
            var input = this.newnote;
            this.$http.post('/vuenotes',input).then((response) => {
                this.changePage(this.pagination.current_page);
            this.newnote = {'title':'','content':''};
            $("#create-note").modal('hide');
            toastr.success('新增成功', '成功訊息', {timeOut: 5000});
        }, (response) => {
                this.formErrors = response.data;
            });
        },
        deletenote: function(note) {
            this.$http.delete('/vuenotes/'+note.id).then((response) => {
                this.changePage(this.pagination.current_page);
            toastr.success('刪除成功', '成功訊息', {timeOut: 5000});
        });
        },
        editnote: function(note) {
            this.fillnote.title = note.title;
            this.fillnote.id = note.id;
            this.fillnote.content = note.content;
            $("#edit-note").modal('show');
        },
        updatenote: function(id) {
            var input = this.fillnote;
            this.$http.put('/vuenotes/'+id,input).then((response) => {
                this.changePage(this.pagination.current_page);
            this.newnote = {'title':'','content':'','id':''};
            $("#edit-note").modal('hide');
            toastr.success('更新成功', '成功訊息', {timeOut: 5000});
        }, (response) => {
                this.formErrors = response.data;
            });
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getVuenote(page);
        }
    }
});