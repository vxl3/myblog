import os
from telegram import Update
from telegram.ext import ApplicationBuilder, CommandHandler, ContextTypes

TOKEN = os.getenv("TELEGRAM_TOKEN")

app = ApplicationBuilder().token(TOKEN).build()

async def start(update: Update, context: ContextTypes.DEFAULT_TYPE):
    welcome_message = """
    <b>مرحبا بك في بوتنا الرائع! 🌟</b>
    <i>شلون أگدر أساعدك اليوم؟</i>

    ————————
    🔹 ارسل صورة لتحويلها لرسمة كرتونية
    🔹 ارسل /help لمعرفة الأوامر
    """
    await update.message.reply_text(welcome_message, parse_mode='HTML')

app.add_handler(CommandHandler("start", start))

app.run_polling()
