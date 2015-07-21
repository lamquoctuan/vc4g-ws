<?php
$purchasedItems = getPurchasedItems(['Gold', 'Silver', 'Platinum', 'Jewellery']);
$types = array_keys($purchasedItems);
?>
<!-- whatwebuy Grid Section -->
<section id="whatwebuy" class="bg-light-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h2 class="text-right pr10">What we buy</h2>
                <ul id="tabs" class="nav nav-tabs pr10" data-tabs="tabs">
<?php foreach ($types as $type) {
    $index = array_search($type, $types);
    ?>
                    <li<?php echo ($index == 0)?' class="active"':'';?>><a href="#<?php echo strtolower($type);?>" data-toggle="tab" <?php echo ($index == 0)?' class="first"':'';?>><?php echo $type;?></a></li>
<?php } ?>
                </ul>
                <a href="<?php echo site_url('/what-we-buy/');?>" class="viewall">View all</a>
            </div>
            <div class="col-sm-9">
                <div class="tab-content">
<?php if (! empty($purchasedItems) ) {
    foreach ($purchasedItems as $type=>$items) {
        $typeLower = strtolower($type);
        $activeClass = (array_search($type, $types) == 0)?' active':'';
        ?>
                    <div class="row<?php echo $activeClass;?> tab-pane fade in" id="<?php echo $typeLower;?>">
                        <div class="row mb20 btn-row-next">
                            <div class="controls pull-right">
                                <a class="right icon-next btn btn-primary" href="#prd-<?php echo $typeLower;?>"  data-slide="next"></a>
                            </div>
                        </div>
                        <div id="prd-<?php echo $typeLower;?>" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
<?php
        $row = 0;
        $col = 0;
        $num = count($items);
        foreach ($items as $item) {
            if ($col == 0) {
                $activeItem = ($row==0)?' active':'';
                ?>
                                <div class="item<?php echo $activeItem;?>">
                                    <div class="row">
            <?php
            }
            ?>
                                        <div class="col-md-4 whatwebuy-item">
                                            <a href="tel:16045582026" class="whatwebuy-link">
                                                <div class="whatwebuy-hover">
                                                    <div class="whatwebuy-hover-content">
                                                        <strong>$<?php echo $item->price;?></strong>
                                                        <span>Call for</span>
                                                        <span class="mb20">better price</span>
                                                        <i class="fa icon-call"></i>
                                                    </div>
                                                </div>
                                                <img src="<?php echo $item->image;?>" class="img-responsive" alt="<?php echo $item->title;?>">
                                            </a>
                                            <div class="whatwebuy-caption">
                                                <h5><?php echo $item->title;?></h5>
                                            </div>
                                        </div>
            <?php
            if ($col == 2 || $num-(3*$row)-1==$col) { ?>
                                    </div>
                                </div>
            <?php
            }
            $col = ($col < 2)?$col+1:0;
            if ($col == 0) {
                $row = $row + 1;
            }
        }
?>
                            </div>
                        </div>


                    </div>
<?php }
} ?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#tabs').tab();
            });
        </script>
    </div>
</section>