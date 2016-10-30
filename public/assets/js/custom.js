$(document).ready(function() {
    $('.slug-link:first , #slug-link').friendurl({id : 'slug-link', divider: '-', transliterate: true});
});

function DeleteConfirm(title){
    if(confirm("Are you sure to delete - " + title) == true) {
        return true;
    } else {
        return false;
    }
}