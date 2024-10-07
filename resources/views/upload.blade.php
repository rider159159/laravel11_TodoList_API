<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="file">選擇文件:</label>
    <input type="file" name="file" id="file" required>
    <button type="submit">上傳</button>
</form>