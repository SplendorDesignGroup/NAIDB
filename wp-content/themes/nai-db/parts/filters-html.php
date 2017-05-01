<h6><?php the_field('filters_title', 'options') ?></h6>
<p>
    <input type="checkbox" name="industrial" id="industrial" class="property_type filter-properties"/>
    <label for="industrial" class="type_label">
        <img src="<?php bloginfo('template_url') ?>/images/map-red.png"/>
        <span><?php the_field('industrial_type_title', 'options') ?></span>
    </label>
</p>
<p>
    <input type="checkbox" name="land" id="land" class="property_type filter-properties" />
    <label for="land" class="type_label">
        <img src="<?php bloginfo('template_url') ?>/images/map-yellow.png"/>
        <span><?php the_field('land_type_title', 'options') ?></span>
    </label>
</p>
<p>
    <input type="checkbox" name="office" id="office" class="property_type filter-properties" />
    <label for="office" class="type_label">
        <img src="<?php bloginfo('template_url') ?>/images/map-dark.png"/>
        <span><?php the_field('office_type_title', 'options') ?></span>
    </label>
</p>
<p>
    <input type="checkbox" name="retail" id="retail" class="property_type filter-properties" />
    <label for="retail" class="type_label">
        <img src="<?php bloginfo('template_url') ?>/images/map-blue.png"/>
        <span><?php the_field('retail_type_title', 'options') ?></span>
    </label>
</p>
<hr>
<form action="#" method="post">
    <p>
        <input type="radio" name="status" id="active" class="property_status" value="active" />
        <label for="active"
               class="status_label"><?php the_field('for_sale_title', 'options') ?></label>
    </p>
    <p>
        <input type="radio" name="status" id="closed" class="property_status"  value="closed" />
        <label for="closed"
               class="status_label"><?php the_field('for_lease_title', 'options') ?></label>
    </p>
    <p>
        <input type="radio" name="status" id="both" class="property_status"  value="both" />
        <label for="both"
               class="status_label"><?php the_field('both_title', 'options') ?></label>
    </p>
    <input class="property_status_submit" type="submit" value="submit" />
</form>
<hr>
<select class="property-country filter-select">
    <option value="0">Select County</option>
    <?php foreach ($pr_countries as $item) : ?>
        <option value="<?php echo $item ?>" ><?php echo $item ?></option>
    <?php endforeach; ?>
</select>
<select class="property-city filter-select">
    <option value="0">Select Town/City</option>
    <?php foreach ($pr_cities as $item) : ?>
        <option value="<?php echo $item ?>"><?php echo $item ?></option>
    <?php endforeach; ?>
</select>
<?php get_search_form(); ?>