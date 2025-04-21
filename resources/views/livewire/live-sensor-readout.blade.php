<div class="bg-white/50 backdrop-blur-sm p-6 rounded-lg">
    <div class="grid grid-cols-[4rem_1fr] ">
        <div>
                    <img src="{{$dataType->getIcon()}}" alt="{{$dataType}} icon">
        </div>
        <dl class="flex flex-col inline-block">
            <dt><p>Temperature</p></dt>
            <dd><p class="text-4xl font-medium">14.4˚C</p></dd>
        </dl>
    </div>
    <div class="flex gap-1">
        <svg class="fill-amber-300 h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 -960 960 960"
            fill="currentColor"
        >
            <path d="M280-120v-80h160v-124q-49-11-87.5-41.5T296-442q-75-9-125.5-65.5T120-640v-40q0-33 23.5-56.5T200-760h80v-80h400v80h80q33 0 56.5 23.5T840-680v40q0 76-50.5 132.5T664-442q-18 46-56.5 76.5T520-324v124h160v80H280Zm0-408v-152h-80v40q0 38 22 68.5t58 43.5Zm200 128q50 0 85-35t35-85v-240H360v240q0 50 35 85t85 35Zm200-128q36-13 58-43.5t22-68.5v-40h-80v152Zm-200-52Z"/>
        </svg>
        <p class="text-amber-300 font-medium">Recommended: 24.4˚C</p>
    </div>
    <div>
    
    </div>
</div>
