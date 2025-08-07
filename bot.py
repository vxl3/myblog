import os
import io
from PIL import Image
from telegram import Update
from telegram.ext import ApplicationBuilder, MessageHandler, ContextTypes, filters

from diffusers import StableDiffusionImg2ImgPipeline
import torch

# تحميل التوكن من environment
TOKEN = os.getenv("TELEGRAM_TOKEN")

# تحميل نموذج Stable Diffusion مع كرتون ستايل
pipe = StableDiffusionImg2ImgPipeline.from_pretrained(
    "CompVis/stable-diffusion-v1-4", 
    torch_dtype=torch.float16, 
    revision="fp16", 
    use_auth_token=False
).to("cuda" if torch.cuda.is_available() else "cpu")

pipe.safety_checker = lambda images, **kwargs: (images, False)  # تعطيل فلتر الحماية

async def handle_photo(update: Update, context: ContextTypes.DEFAULT_TYPE):
    await update.message.reply_text("جاري تحويل صورتك بواسطة الذكاء الاصطناعي... ⏳")

    photo_file = await update.message.photo[-1].get_file()
    photo_bytes = await photo_file.download_as_bytearray()
    original_image = Image.open(io.BytesIO(photo_bytes)).convert("RGB").resize((512, 512))

    # تحويل الصورة إلى كرتونية (ستايل معين)
    prompt = "a cartoon-style portrait, colorful, smooth lines, clean anime look"
    result = pipe(prompt=prompt, image=original_image, strength=0.75, guidance_scale=7.5).images[0]

    output = io.BytesIO()
    output.name = "converted.jpg"
    result.save(output, format="JPEG")
    output.seek(0)

    await update.message.reply_photo(photo=output, caption="هاي صورتك بعد التحويل 🎨")

if __name__ == '__main__':
    app = ApplicationBuilder().token(TOKEN).build()
    app.add_handler(MessageHandler(filters.PHOTO, handle_photo))
    app.run_polling()
