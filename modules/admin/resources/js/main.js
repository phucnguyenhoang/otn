$(function() {
    Admin.run();
});
var Admin = {
    init: function() {
        this._initDataTable();
    },
    eventHandle: function() {

    },
    _initDataTable: function() {
        $('.data-tables').DataTable({
            responsive: true
        });
    },
    run: function() {
        this.init();
        this.eventHandle();
    }
};

var Verify = {
    eventHandle: function(){
        
    },
    run: function(){
        this.eventHandle();
    }
}