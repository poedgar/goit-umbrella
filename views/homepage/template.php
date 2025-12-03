<!-- {{--about section --}} -->
<section class="section">
	<div class="container">

		<h2 class="section-title">ПРО НАС
		</h2>

		<p class="low-section-title mt-5 md:mt-8">Від локальних IT-курсів до міжнародної мультипродуктової EdTech-компанії</p>

		<!-- {{-- about slider --}} -->
		<div class="mt-5 md:mt-8 flex flex-col-reverse md:flex-col gap-5 md:gap-8">
			<!-- {{-- about btns --}} -->
			<div class="flex items-center justify-between gap-5 text-[20px]/[28px]">
				<button class="about-prev-btn flex items-center justify-center border border-black p-4 w-[150px] md:w-[98px] h-[44px] rounded-[4px]" type="button" aria-label="до попереднього слайду"
					style="" aria-disabled="false">
					назад
				</button>

				<button class="about-next-btn flex items-center justify-center text-white bg-black p-4 w-[150px] md:w-[98px] h-[44px] rounded-[4px]" type="button" aria-label="до наступного слайду"
					style="" aria-disabled="false">
					вперед
				</button>
			</div>

			<!-- {{-- about slides list --}} -->
			<div class="flex gap-5 md:gap-8">
				<!-- {{-- Swiper slide --}} -->
				<div class="flex smOnly:flex-col smOnly:gap-5 bg-white rounded-[8px] smOnly:p-5 md:overflow-hidden lg:w-[768px]">
					<!-- {{-- slide image --}} -->
					<img class="shrink-0 w-full h-[280px] md:w-[352px] xl:w-[384px] md:h-[640px] bg-yellow-300 smOnly:rounded-[8px]" src="" alt="{{ get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: 'лого бренду' }}" width="72" height="72" loading="lazy" />

					<!-- {{-- slide content --}} -->
					<div class="flex flex-col h-full gap-5 md:p-8 md:gap-8">
						<h3 class="text-[32px]/[36px] font-unbounded font-extrabold md:text-[48px]/[1]">2014</h3>

						<p class="text-[20px]/[28px] uppercase">Одними з перших починаємо навчати світчерів ІТ-професіям</p>

						<div class="smOnly:hidden md:space-y-7 md:grow">
							<p>2014 рік. Україна прагне стати частиною Європи і світу. Українці об’єднуються та створюють круті, змінотворчі ініціативи.</p>
							<p>Школа GoIT — одна з таких ініціатив. У нас були знання з ІТ, готовність ділитися ними та бажання бачити Україну ІТ-нацією з фахівцями світового рівня. </p>
							<p>Ми починаємо збирати групи в Києві і навчати світчерів розробці.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>