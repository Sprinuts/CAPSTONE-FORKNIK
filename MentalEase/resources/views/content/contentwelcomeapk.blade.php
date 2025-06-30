<div>
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
    <form action="{{ route('updateapk') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Upload a file:</label>
        <input type="file" name="file" id="file">
        <button type="submit">Upload</button>
    </form>
</div>

@if(isset($apkPath) && $apkPath)
    <div class="mt-4">
        <p>Latest APK:</p>
        <a href="{{ asset($apkPath) }}" class="btn btn-success" download>Download Latest APK</a>
    </div>
@else
    <div class="mt-4">
        <p>No APK uploaded yet.</p>
    </div>
@endif