<html>
    <head>
        <title>Upload Data</title>
    </head>
    <body>
        <h1>Upload new CSV by browsing to file and clicking on Upload</h1>
        <form enctype='multipart/form-data' action='doUploadData.php' method='post'>
            File name to import:<br />
            <input type='file' name='filename'><br />
            <input type='submit' name='submit' value='Upload'>
        </form>
    </body>
</html>