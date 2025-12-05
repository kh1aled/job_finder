<!DOCTYPE html>
<html>
    <head>
        <title>Welcome from Upload Avatar</title>
    </head>
    <body>
        <h1>Upload Video</h1>
        <form action="{{ route('upload.video') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="video" id="video">
            <button type="submit">Upload</button>
        </form>
    </body>
</html>