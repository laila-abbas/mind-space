<section class="space-y-6" x-data="imageCropper()">
    <header>
        <h2 class="text-2xl font-bold text-gray-900">Account Information</h2>
    </header>
    <x-forms.form 
        method="PATCH" 
        action="{{ route('profile.updateInfo') }}" 
        enctype="multipart/form-data" 
        class="max-w-full"
    >
        {{-- Hidden inputs for backend processing --}}
        <input type="hidden" name="cropped_avatar" :value="croppedData">
        <input type="hidden" name="remove_avatar" :value="removeAvatar">

        <div class="flex items-center gap-10 px-6 py-4 bg-primary/5 rounded-2xl border border-primary/50">
            <div class="relative w-20 h-20 group">
                <img 
                    :src="imageUrl"
                    class="w-20 h-20 rounded-full object-cover ring-1 ring-primary"
                >

                <span
                    @click="deleteAvatar"
                    class="absolute -top-2 -right-2 bg-white text-red-600 w-5.5 h-5.5 rounded-full flex items-center justify-center shadow-md border border-gray-100 hover:bg-red-50 hover:scale-110 transition-all duration-200 cursor-pointer opacity-0 group-hover:opacity-100 z-10"
                    title="Remove photo"
                >
                    <img 
                        src="{{ asset('images/x.svg') }}" 
                        alt="Remove photo"
                        class="w-3.5 h-3.5"
                    >
                </span>
            </div>
            <div>
                <x-forms.field label="Profile Photo" name="cropped_avatar" :errorBag="'updateProfileInformation'">
                    <input 
                        type="file" 
                        x-ref="fileInput"
                        accept="image/*"
                        @click="$refs.fileInput.value = ''"
                        @change="setupCropper" 
                        class="hidden"
                    >
                    <button
                        type="button"
                        @click="$refs.fileInput.click()"
                        class="cursor-pointer text-sm text-gray-500 mr-4 py-2 px-4 rounded-full border-0 text-sm font-semibold bg-secondary text-white hover:bg-third cursor-pointer"
                    >
                        Choose Photo
                    </button>

                </x-forms.field>
                <p class="text-xs text-gray-500 mt-2">Recommended: Square JPG or PNG, max 2MB.</p>
                
                <template x-if="removeAvatar">
                    <span class="text-xs text-orange-500 font-bold mt-1 block animate-pulse">
                        Photo will be removed on save.
                    </span>
                </template>

                <template x-if="imageUrl !== '{{ auth()->user()->avatar_url }}' && !removeAvatar">
                    <span class="text-xs text-orange-500 font-bold mt-1 block animate-pulse">
                        Click "Save Changes" to apply your new photo.
                    </span>
                </template>

            </div>
        </div>

        <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-cloak>
            <div class="bg-white rounded-2xl p-6 max-w-lg w-full shadow-xl">
                <h3 class="text-lg font-bold mb-4 text-center">Adjust your photo</h3>
                <div class="overflow-hidden rounded-lg bg-gray-100 max-h-[400px]">
                    <img id="cropper-target" class="block max-w-full">
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-gray-600 font-semibold cursor-pointer">Cancel</button>
                    <button type="button" @click="applyCrop" class="px-6 py-2 bg-secondary hover:bg-third cursor-pointer text-white rounded-xl font-bold">Done</button>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-forms.input label="First Name" name="first_name" :errorBag="'updateProfileInformation'" :value="old('first_name', auth()->user()->first_name)" required />
            <x-forms.input label="Last Name" name="last_name" :errorBag="'updateProfileInformation'" :value="old('last_name', auth()->user()->last_name)" />
        </div>

        <x-forms.input label="Email" name="email" type="email" :errorBag="'updateProfileInformation'" :value="old('email', auth()->user()->email)" class="max-w-lg" required />

        @role('Author') 
            <div class="pt-6 border-t border-gray-100">
                <h3 class="text-sm font-bold uppercase tracking-wider text-third mb-6">Author Info</h3>
                
                <div class="space-y-6">
                    <x-forms.input label="Pen Name" name="pen_name" :errorBag="'updateProfileInformation'" :value="old('pen_name', auth()->user()->author?->pen_name)" placeholder="How your name appears on books" class="max-w-lg" />
                    
                    <x-forms.input label="Biography" name="biography" type="textarea" :errorBag="'updateProfileInformation'" :value="old('biography', auth()->user()->author?->biography)" class="max-w-lg" />
                    
                    <x-forms.input label="Personal Website" name="website_url" type='url' :errorBag="'updateProfileInformation'" :value="old('website_url', auth()->user()->author?->website_url)" placeholder="https://..." class="max-w-lg" />
                </div>
            </div>
        @endrole
        <div class="flex justify-end pt-4">
            <div>
                <x-forms.button class='px-6 py-3'>Save Changes</x-forms.button>
            </div>
        </div>
    </x-forms.form>
</section>

<script>
    function imageCropper() {
        return {
            imageUrl: '{{ auth()->user()->avatar_url }}',
            croppedData: null,
            showModal: false,
            cropper: null,
            removeAvatar: false,

            setupCropper(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.showModal = true;
                    this.$nextTick(() => {
                        const image = document.getElementById('cropper-target');
                        image.src = e.target.result;

                        if (this.cropper) this.cropper.destroy();

                        this.cropper = new Cropper(image, {
                            aspectRatio: 1,
                            viewMode: 1,
                            dragMode: 'move',
                            guides: false,
                            center: true,
                            highlight: false,
                            cropBoxMovable: true,
                            cropBoxResizable: false, 
                            toggleDragModeOnDblclick: false,
                        });
                    });
                };
                reader.readAsDataURL(file);
            },

            applyCrop() {
                const canvas = this.cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                });

                this.croppedData = canvas.toDataURL('image/jpeg', 0.9);
                this.imageUrl = this.croppedData;
                this.removeAvatar = false; // reset removal flag because we just added a new one
                this.showModal = false;
            },

            deleteAvatar() {
                this.imageUrl = '{{ asset('images/default-avatar.png') }}';
                this.croppedData = null;
                this.removeAvatar = true;

                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }
                this.$refs.fileInput.value = '';
            }   
        }
    }
</script>