<div class="flex items-center" x-data="picturePreview()">
    <div class="rounded-md bg-gray-200 mr-2">
        <span class="text-xs text-center text-gray-500">
            <img :src="imageUrl ? imageUrl : '{{ Auth::user()->picture ? asset('storage/' . Auth::user()->picture) : URL('images/user-default-avatar.png') }}'" alt="Photo de profil"
                class="w-24 h-24 rounded-md object-cover border-4 border-dark-300">
        </span>
    </div>
    <div>
        <x-secondary-button @click="document.getElementById('picture').click()" class="relative">
            <div class="flex items-center text-sm font-normal normal-case">
                <span class="material-icons-outlined">Add a photo</span>
            </div>
            <input @change="fileChosen(event)" type="file" name="picture" id="picture"
                class="absolute inset-0 -z-10 opacity-0">
        </x-secondary-button>
    </div>

    <script>
        function picturePreview() {
            return {
                imageUrl: '', // Initialize with an empty string

                fileChosen(event) {
                    this.fileToDataUrl(event, (src) => {
                        this.imageUrl = src; // Update preview with selected file
                    });
                },

                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return;

                    let file = event.target.files[0],
                        reader = new FileReader();

                    reader.readAsDataURL(file);
                    reader.onload = (e) => callback(e.target.result);
                },
            };
        }
    </script>
</div>
