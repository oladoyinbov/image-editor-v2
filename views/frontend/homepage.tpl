{extends file="frontend/layout.tpl"}

{block name='header-code'}
    <script src="{asset file='js/jquery/jquery.min.js'}"></script>
    <script src="{asset file='js/htmx.min.js'}"></script>
    <style>
    body, h1, b {
        font-family: 'Inter', sans-serif;
    }
    </style>
{/block}

{block name='body'}
    <div class="flex justify-center m-4 min-h-screen bg-base-200 mb-5">
        <div class="glass hero-content flex-col lg:justify-around lg:w-[70vw] lg:flex-row-reverse md:flex-row lg:gap-5">
            <div class="card shrink-0 max-w-xl shadow-sm bg-base-100 p-[30px]">
                <h1 class="flex justify-center justify-items-center text-[30px] gap-2" style="font-weight: 999;">
                    <i class="fad fa-image-polaroid text-[1.5em]"></i> Image <span class="text-red-400">Optimizer</span>
                </h1>
                <div id='alert_message'>
                    {$flash_message}
                </div>

                <form class="card-body mt-0" method="post" enctype="multipart/form-data"
                    hx-post="{route to='compress_image'}" hx-target="#result" hx-replace="innerHTML" hx-trigger="submit"
                    hx-indicator="#spinner" id="cmp_form">
                    <div class="form-control">
                        <label class="label" for="image_file">
                            <span class="label-text">Select Image</span>
                        </label>
                        <input type="file" name="image" id="image_file" class="file-input file-input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label" for="compression_level">
                            <span class="label-text">Clarity Level</span>
                        </label>
                        <input type="range" id="compression_level" min="1" max="100" value="80" class="range"
                            name="level" />
                        <div class="w-full flex justify-between text-xs px-2">
                            <span>20%</span>
                            <span>40%</span>
                            <span>60%</span>
                            <span>80%</span>
                            <span>100%</span>
                        </div>
                    </div>
                    <div class="form-control w-full p-3 bg-slate-800 mt-2">
                        <label class="cursor-pointer label">
                            <span class="label-text text-white"><i class="fad fa-signal-4 text-light"></i> Realtime</span>
                            <input type="checkbox" class="toggle toggle-warning" id="realtime_opt" />
                        </label>
                    </div>
                    <div class="form-control w-full p-3 bg-slate-800 mt-2">
                        <label class="cursor-pointer label">
                            <span class="label-text text-white align-items-center">
                                <i class="fab fa-instagram text-primary text-xl"></i>
                                Optimize For Social Media
                            </span>
                            <input type="checkbox" class="toggle toggle-warning" />
                        </label>
                    </div>
                    <div class="form-control mt-3">
                        <span class="mb-3" id="spinner" style="display: none;">
                            <span class="flex justify-center bg-black-900">
                                <img src="{asset file="images/loader2.svg"}">
                            </span>
                        </span>
                        <button class="btn btn-primary text-[20px]" id="cmp_btn" type="submit"><i
                                class="fad fa-compress-arrows-alt"></i> Optimize Now</button>
                    </div>
                </form>
            </div>
            <div id="result">
                <div class="artboard-demo indicator" id="sub_result">
                    <span id="indic"
                        class="indicator-item indicator-top indicator-right badge badge-success text-white">new!</span>
                    <img 
                        src="{asset file="images/test.jpg"}" 
                        width="350px" height="350px" 
                        style="max-width: 450px; max-height: 450px"
                        id="img_prev" 
                        class="mb-5">
                    <button class="btn btn-success mb-3" id="download_btn"><i class="fad fa-download"></i> Download</button>
                </div>
            </div>
        </div>
    </div>
{/block}

{block name='footer'}
    <script src="{asset file='js/chunk.828.js'}"></script>
{/block}