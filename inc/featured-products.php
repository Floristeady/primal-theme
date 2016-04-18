<section id="id-products" class="home-section line-yellow">
	<div class="row">
		<div class="column medium-12 small-centered">
			<div class="title">
				<h1>NUESTROS <span>PRODUCTOS</span></h1>
			</div>
		
			<script type="text/html" data-template="featured-products">
			  %{items}
			    <li class="column">
			    	<div class="inner">
				      %{hasImage}
				      <span class="img">
				        <a href="%{ href }" class="button-img" title="%{ title }">
				          <img src="%{ image.sizes.medium  }" />
				        </a>
				      </span>
				      %{/hasImage}
				      <div class="info">
						<h3 class="clearfix"><a class="title" title="%{ title }" href="%{ href }">%{ title }</a></h3>
						%{hasPrice}
						<p class="prices">
				          <span class="price">$%{ formatted_price }</span>
				           %{hasPrice_comparison}
					       <span class="price_comparison"><strike>$%{ price_comparison }</strike></span>
					    %{/hasPrice_comparison}
				      	</p>
				      %{/hasPrice}
				    </div>

				    <a class="other-button" href="%{ href }">Comprar</a>
			    	</div>
			    </li>
			  %{/items}
			</script>
			
		
			<?php //See http://bootic.github.io/bootic_search_widget.js for more options and examples ?>
			<ul class="products small-up-2 medium-up-3 large-up-5" 
			  data-bootic_widget="ProductSearch" 
			  data-template="featured-products" 
			  data-config_per_page="5" 
			  data-config_collections="featured" 
			  data-config_shop_subdomains="primal"  
			  data-autoload="true">
			</ul>	
			
		</div>
		
		<span class="icon-arrow"></span>
	
	</div>
</section>
		