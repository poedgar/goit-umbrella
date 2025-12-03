import imagemin from 'imagemin';
import imageminGifsicle from 'imagemin-gifsicle';
import imageminJpegtran from 'imagemin-jpegtran';
import imageminOptipng from 'imagemin-optipng';
import imageminSvgo from 'imagemin-svgo';
import path from 'path';
import { fileURLToPath } from 'url';
import glob from 'glob';

// Отримуємо __dirname у модулях ES
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Читаємо шляхи з env або дефолтні
const src =
  process.env.npm_package_config_image_src ||
  path.join(__dirname, 'src/images');
const dist =
  process.env.npm_package_config_image_dist ||
  path.join(__dirname, 'dist/images');

// Використовуємо glob для пошуку всіх файлів у src
const files = glob.sync(`${src}/**/*.{jpg,jpeg,png,gif,svg}`);

(async () => {
  try {
    await imagemin(files, {
      destination: dist,
      plugins: [
        imageminGifsicle(),
        imageminJpegtran(),
        imageminOptipng(),
        imageminSvgo({
          plugins: [
            { name: 'removeViewBox', active: false },
            { name: 'removeDimensions', active: true },
            { name: 'cleanupAttrs', active: true },
            { name: 'removeDoctype', active: true },
            { name: 'removeComments', active: true },
          ],
        }),
      ],
    });
    console.log('Images optimized successfully!');
  } catch (err) {
    console.error('Error during image optimization:', err);
    process.exit(1);
  }
})();
