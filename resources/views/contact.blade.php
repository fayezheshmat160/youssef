{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<div class="container py-5">
    <h2 class="text-center mb-4">تواصل معنا</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الرسالة</label>
            <textarea name="message" rows="5" class="form-control" required></textarea>
        </div>

        <button class="btn btn-success w-100">إرسال</button>
    </form>
</div>


</body>
</html>
 --}}


 <div class="col-md-7 contact-form">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="اكتب اسمك هنا" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">الموضوع</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="موضوع الرسالة" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">الرسالة</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="اكتب رسالتك هنا..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-send w-100">إرسال الرسالة</button>
    </form>

</div>