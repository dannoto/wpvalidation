<?php 
    $target = $url->url;
    if($url->profileid || $url->qrid){
        $target = \Helpers\App::shortRoute($url->domain, $url->alias.$url->custom);
    }
    $target .= (strpos($target, '?') !== false ? '&' : '?') . 'passed=1';
?>
<section class="py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7 text-center">
                
                <!-- Top Ad -->
                <div class="mb-2 overflow-hidden rounded-3 p-1 d-inline-block mx-auto">
                    <?php \Helpers\App::ads('redirect_top') ?>
                </div>

                <!-- Countdown Message -->
                <div class="card shadow-lg rounded-5 border-0 mb-5 overflow-hidden">
                    <div class="card-body p-3">
                        <div class="mb-4">
                            <span class="badge bg-soft-primary text-primary rounded-pill px-3 py-2 fw-bold text-uppercase ls-1"><?php ee('Redirecting') ?></span>
                        </div>
                        <h2 class="h1 fw-black mb-3"><?php ee('You are being redirected in...') ?></h2>
                        <div class="timer-wrapper my-4">
                            <div id="timer-count" class="display-1 fw-black text-primary">5</div>
                        </div>
                        <p class="text-muted lead"><?php ee('Please wait a moment while we prepare your destination.') ?></p>
                        
                        <div class="progress mt-5 mb-3" style="height: 6px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" id="progress-timer"></div>
                        </div>

                        <div class="mt-4">
                            <a href="<?php echo $target ?>" class="text-decoration-none text-muted small fw-bold"><?php ee('Not redirecting? Click here') ?> <i data-feather="arrow-right" class="ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- CTA Footer -->
                <div class="card bg-dark text-white rounded-5 border-0 p-4 p-md-5 mb-5 shadow-lg position-relative overflow-hidden">
                    <div class="position-absolute top-0 end-0 p-4 opacity-10">
                        <i data-feather="zap" style="width: 120px; height: 120px;"></i>
                    </div>
                    <div class="card-body position-relative z-index-1">
                        <div class="row align-items-center">
                            <div class="col-md-9 text-md-start mb-4 mb-md-0">
                                <h3 class="fw-bold mb-2"><?php ee('Create your own short links!') ?></h3>
                                <p class="mb-0 text-white-50 lead"><?php ee('Join us to get advanced analytics, custom bios, and dynamic QR codes.') ?></p>
                            </div>
                            <div class="col-md-3 text-md-end">
                                <a href="<?php echo route('register') ?>" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold shadow-primary hvr-grow"><?php ee('Get Started') ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scroll Down Hint -->
                <div class="mt-5 text-muted small animate-bounce">
                    <p class="mb-2"><?php ee('Scroll for more') ?></p>
                    <i data-feather="chevron-down"></i>
                </div>

                <!-- Ads below the fold -->
                <div style="margin-top: 50vh;"></div>
                
                <h5 class="text-uppercase ls-2 text-muted mb-4 small fw-bold"><?php ee('Sponsored Content') ?></h5>
                <div class="row g-4 justify-content-center mb-5">
                    <div class="col-md-6">
                        <div class="p-1 h-100 d-flex align-items-center justify-content-center">
                            <?php \Helpers\App::ads('redirect_square') ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-1 h-100 d-flex align-items-center justify-content-center">
                            <?php \Helpers\App::ads('redirect_square') ?>
                        </div>
                    </div>
                </div>

                <div class="mt-3 p-1 d-inline-block mx-auto">
                    <?php \Helpers\App::ads('redirect_bottom') ?>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    .fw-black { font-weight: 900; }
    .ls-1 { letter-spacing: 1px; }
    .ls-2 { letter-spacing: 2px; }
    .bg-soft-primary { background-color: rgba(var(--primary-rgb), 0.1); }
    
    #timer-count {
        font-variant-numeric: tabular-nums;
        text-shadow: 0 10px 20px rgba(var(--primary-rgb), 0.2);
    }
    
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
        40% {transform: translateY(-10px);}
        60% {transform: translateY(-5px);}
    }
    
    .hvr-grow {
        transition: transform 0.3s ease;
    }
    .hvr-grow:hover {
        transform: scale(1.05);
    }
    
    #progress-timer {
        transition: width 1s linear;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let timeLeft = 5;
        let progressBar = document.getElementById('progress-timer');
        let interval = setInterval(function() {
            timeLeft--;
            if (progressBar) progressBar.style.width = (timeLeft / 5 * 100) + '%';
            if (timeLeft <= 0) {
                clearInterval(interval);
            }
        }, 1000);
    });
</script>
