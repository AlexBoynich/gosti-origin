<form
        method="POST"
        enctype="multipart/form-data"
        action="{{ route('cp.store') }}">
    @csrf
    <input type="file" name="image"><br>
    <input type="submit" title="Сохранить">
</form>