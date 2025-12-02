<!-- {{--video section --}} -->
<section class="section">
	<div class="container">
		<div class="bg-white p-5 borded-[8px] grid gap-5 md:gap-8 xl:flex">
			<div class="flex flex-col gap-5 md:gap-8 xl:order-1 xl:items-center xl:justify-center">
				<h2 class="section-title">Від знань до впливу</h2>

				<p class="text-[20px]/[28px] font-medium uppercase md:text-[24px]/[32px] text-center">Ми віримо: освіта не має віку. Вона не починається з диплома. Вона починається з рішучості.</p>
			</div>

			<a href="" class="cursor-pointer rounded-[8px] bg-accent overflow-hidden relative xl:order-0 xl:shrink-0"
				rel="noopener noreferrer nofollow" target="_blank">
				<div class="relative bg-red-500">
					<img class="rounded-[8px] w-full h-full md:h-[450px] xl:w-[800px]" alt="" height="498" loading="lazy"
						src="" width="280"
						class="" title="">

					<button
						class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 px-4 py-2 bg-black rounded-[4px] z-20 shrink-0 hover:scale-[1.1] focus:scale-[1.1] active:scale-[1.1]"
						type="button" aria-label="кнопка відкриття модального вікна з відео"
						tabindex="0">
						дивитися
					</button>
				</div>
			</a>
		</div>
	</div>
</section>

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

<!-- {{--Articles section --}} -->
<section class="section">
	<div class="container">

		<h2 class="section-title">Віримо в освіту, що рухає вперед</h2>

		<p class="low-section-title mt-5 md:mt-8">Тому підтримуємо соціальні та освітні ініціативи й запускаємо власні, щоб відкривати більше можливостей і створювати зміни</p>

		<!-- {{-- Articles slider wrapper with btns --}} -->
		<div class="mt-5 md:mt-8 flex flex-col-reverse md:flex-col gap-5 md:gap-8">
			<!-- {{-- Articles btns --}} -->
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

			<!-- {{-- Articles slides list --}} -->
			<div class="flex gap-5 md:gap-8">
				<!-- {{-- Swiper slide --}} -->
				<div class="bg-white rounded-[8px] p-5 md:w-[336px] md:p-8">
					<!-- {{-- slide image --}} -->
					<img class="shrink-0 w-full h-[218px] rounded-[8px] bg-pink-300"
						src="{{ wp_get_attachment_image_url($slide['image'], 'full') }}"
						alt="{{ $slide['title'] ?? 'декорація' }}" width="280" height="218"
						loading="lazy" />

					<!-- {{-- slide title --}} -->
					<h3 class="mt-5 md:mt-8 font-medium text-[20px]/[28px] uppercase">
						Зібрали й передали понад 200 000 грн на відбудову шкіл та укриттів у партнерстві з UNITED24
					</h3>
				</div>
				<!-- {{-- other slides --}} -->
			</div>
		</div>
	</div>
</section>

<!-- {{--People section --}} -->
<section class="section">
	<div class="container">
		<h2 class="section-title">Співпраця з нами</h2>

		<!-- {{-- People list --}} -->
		<div class="mt-5 md:mt-16 flex smOnly:flex-col gap-5 md:gap-8">
			<!-- {{-- Articles slides list --}} -->
			<div class="flex gap-5 md:gap-8">
				<!-- {{-- Swiper slide --}} -->
				<div class="bg-white rounded-[8px] p-5 md:w-[336px] md:p-8">
					<!-- {{-- slide image --}} -->
					<img class="shrink-0 w-full h-[218px] rounded-[8px] bg-pink-300"
						src="{{ wp_get_attachment_image_url($slide['image'], 'full') }}"
						alt="{{ $slide['title'] ?? 'декорація' }}" width="280" height="218"
						loading="lazy" />

					<!-- {{-- slide title --}} -->
					<h3 class="mt-5 md:mt-8 font-medium text-[20px]/[28px] uppercase">
						Зібрали й передали понад 200 000 грн на відбудову шкіл та укриттів у партнерстві з UNITED24
					</h3>
				</div>
				<!-- {{-- other slides --}} -->
			</div>
		</div>
	</div>
</section>
