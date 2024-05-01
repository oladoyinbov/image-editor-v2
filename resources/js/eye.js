function eye(id){
    var fid = $(id);
    var fid_attr = fid.attr('type');

    if (fid_attr == 'password'){
        fid.attr('type', 'text');
    } 

    if (fid_attr == 'text'){
        fid.attr('type', 'password');
    }
}