$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ---------------------
// profile promotion
// ---------------------
$uploadCrop = $('#promotionShow').croppie({
    enableExif: true,
    viewport: {
        width: 235,
        height: 300,
        type: 'rounded'
    },
    boundary: {
        width: 320,
        height: 355
    }
});

$('#promotionInput').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
});

var promotionform = $('#promotionCreateForm');
promotionform.submit(function (e) {
    e.preventDefault();
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        var payment_url = "promotionplans";
        console.log("called");
        $.ajax({
            type: promotionform.attr('method'),
            url: promotionform.attr('action'),
            data: {
                "image": resp,
                "title": $('#promotionTitle').val()
            },
            success: function (data) {
                console.log("success");
                window.location = payment_url;
            },
            fail: function (e) {
                console.log("ajax error");
                console.log(e);
            }
        });
       
    });
});
// ---------------------
// Blog post
// ---------------------
$blogUploadCrop = $('#blogShow').croppie({
    enableExif: true,
    viewport: {
           width: 650,
           height: 250,
           type: 'rounded'
       },
       boundary: {
        width: 900,
        height: 400
    }
});

$('#blogInput').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $blogUploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
});

var blogform = $('#blogCreateForm');
blogform.submit(function(e) {
    e.preventDefault();
    $blogUploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        var url = "createBlog";
        $.ajax({
            type: blogform.attr('method'),
            url: blogform.attr('action'),
            data: {
                "image": resp,
                "blogTitle": $('#blogTitle').val(),
                "blogSubTitle": $('#blogSubTitle').val(),
                "description": $('#description').val(),
                "category": $('#category').val(),
            },
            success: function (data) {
                window.location = url;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        });
    });
});
// ---------------------
// Event post
// ---------------------
$eventUploadCrop = $('#eventShow').croppie({
    enableExif: true,
    viewport: {
           width: 650,
           height: 250,
           type: 'rounded'
       },
       boundary: {
        width: 900,
        height: 400
    }
});

$('#eventInput').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $eventUploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
});

var eventform = $('#eventCreateForm');
eventform.submit(function (e) {
            e.preventDefault();
    $eventUploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        
        var url = "createEvent";
        $.ajax({
            type: eventform.attr('method'),
            url: eventform.attr('action'),
            data: {
                "image": resp,
                "title": $('#title').val(),
                "type": $('#type').val(),
                "amount": $('#amount').val(),
                "date": $('#date').val(),
                "time": $('#time').val(),
                "location": $('#location').val(),
                "details": $('#details').val(),
            },
            success: function (data) {
                window.location = url;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        });
    });
});
// ---------------------
// Group post
// ---------------------
$groupUploadCrop = $('#groupShow').croppie({
    enableExif: true,
    viewport: {
           width: 650,
           height: 250,
           type: 'rounded'
       },
       boundary: {
        width: 900,
        height: 400
    }
});

$('#groupInput').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $groupUploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
});

var groupform = $('#groupCreateForm');
groupform.submit(function (e) {
    e.preventDefault();
    $groupUploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        var url = "createGroup";
        $.ajax({
            type: groupform.attr('method'),
            url: groupform.attr('action'),
            data: {
                "image": resp,
                "title": $('#title').val(),
                "type": $('#type').val(),
                "about": $('#about').val(),
            },
            success: function (data) {
                window.location = url;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        });
    });
});