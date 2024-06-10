<?php $__env->startSection('content'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/details.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('js/share.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
    <script src="<?php echo e(asset('asset/js/main.js')); ?>"></script>
<meta property="og:title" content="<?php echo e($product->code); ?>">
<meta property="og:image" content="<?php echo e($product->getFirstMediaUrl('products')); ?>">

    <?php echo \Livewire\Livewire::styles(); ?>


    <main>


        <?php if(Session::has('message')): ?>

            <div class="w-25" x-data="{show: true}" x-init="setTimeout(() => show = false, 1500)" x-show="show">
                <div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
            </div>
        <?php endif; ?>


        <div class="card-wrapper  py-4">
            <div class="card">
                <!-- card left -->
                <div class="product-imgs">
                    <div class="img-display">
                        <div class="img-showcase">

                            <?php $__currentLoopData = $imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img
                                    src="<?php echo e($imgs[$loop->index]->getUrl()); ?>"
                                    alt="shoe image">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="img-select">
                        <?php $__currentLoopData = $imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="img-item">
                                <a href="#" data-id="<?php echo e($loop->index+1); ?>">
                                    <img
                                        src="<?php echo e($imgs[$loop->index]->getUrl()); ?>"
                                        alt=" image">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <!-- card right -->
                <div class="product-content">
                    <h2 class="product-title"><?php echo e(getTrans($product,'name')); ?></h2>

                    <div class="product-price">
                        <p><?php echo e(lang('code')); ?> <span class="new-price"><?php echo e($product->code); ?></span></p>
                    </div>

                    <div class="product-price">
                        <a href="<?php echo e(route('langs.products',[$product->department->category->id ?? 1,
                        $product->department->id??1])); ?>">
                            <p><?php echo e(lang('dep_name')); ?>:
                                <span class="new-price"><?php echo e($product->department->name??"
                        no"); ?></span></p>
                        </a>
                    </div>

                    <div class="product-detail">
                        <h2><?php echo e(lang('details')); ?></h2>
                        <p class="product-detail"><?php echo getTrans($product,'description'); ?></p>


                    </div>
                    <form action="<?php echo e(route('langs.addToCart')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="purchase-info ">
                            <input hidden value="<?php echo e($product->id); ?>" name="product">
                            <input type="number" min="0" value="1" name="num">
                            <button type="submit" class="btn">
                                <?php echo e(lang('cart')); ?> <i class="fas fa-shopping-cart"></i>
                            </button>

                        </div>
                    </form>

                    <div class="social-links">
                        <p><?php echo e(lang('share')); ?>: </p>

                        <?php echo $social=Share::page(url('/details/'.$product->id),$product->getFirstMediaUrl('products'))->facebook(); ?>

                        <?php echo $social=Share::page(url('/details/'.$product->id))->whatsapp(); ?>

                        <?php echo $social=Share::page(url('/details/'.$product->id))->telegram(); ?>

                        <?php echo $social=Share::page(url('/details/'.$product->id))->twitter(); ?>













                    </div>
                </div>
            </div>
        </div>

        


        <div class="container-fluid">
            

            
            

            
            
            
            
            
            


            
            
            
            
            
            

            

            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            


            <div id="relative_products" class="owl-carousel tag-div">

                <?php $__currentLoopData = $allproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tito product-item">


                        <a class="text-decoration-none"
                           href="<?php echo e(route('langs.product_details',[$product])); ?>">
                            <div class="card cards-shadown cards-hover w-100 d-flex flex-column align-items-center"
                                 data-aos="flip-left"
                                 data-aos-duration="950">
                                <div class="card-header px-1 px-md-2 " onmouseover="show(this)" onmouseleave="hide
                                (this)">
                                    <div class="adding-hidden " id="add">
                                        <form action="<?php echo e(route('langs.addToCart')); ?>" method="post">
                                            <?php echo csrf_field(); ?>


                                            <input hidden value="<?php echo e($product->id); ?>" name="product">
                                            <input hidden type="number" min="0" value="1" name="num">
                                            <button type="submit" class="btn">
                                                <i class="fas fa-plus-circle icn"></i>
                                            </button>
                                        </form>

                                    </div>
                                    <img class="img-fluid rounded-img"
                                         src="<?php echo e($product->getFirstMediaUrl('products')); ?>">
                                </div>
                                <div class="card-body after">
                                    <p class="card-text sub-text-color"><?php echo e(getTrans($product,'name')); ?></p>
                                    <span class="card-text sub-text-color"><?php echo e($product->code); ?> </span>
                                    <?php if(app()->getLocale()=="ar"): ?>
                                        <p class="card-text sub-text-color"><?php echo e($product->department->name ??
                                                ""); ?></p>

                                    <?php elseif(app()->getLocale()=="en"): ?>
                                        <p class="card-text
                                                    sub-text-color"><?php echo e($product->department->name_en ??
                                                ""); ?></p>
                                    <?php elseif(app()->getLocale()=="tr"): ?>
                                        <p class="card-text
                                                    sub-text-color"><?php echo e($product->department->name_tr ??
                                                ""); ?></p>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                        </a></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>


        </div>


        <div class=" mt-2 container">
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <a href="#" class="badge badge-dark tags-div py-2 px-2 mb-1"><?php echo e($tag->name); ?></a>


            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </main>
    <script>
        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });

        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            let x = 1;
            if (document.dir === 'ltr') {
                x = -1;
            }
            document.querySelector('.img-showcase').style.transform = `translateX(${x * (imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);
    </script>

    <?php echo \Livewire\Livewire::scripts(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\1\altin\resources\views/pages/product-details.blade.php ENDPATH**/ ?>