<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: "DejaVu Sans", sans-serif; direction: rtl; text-align: right; }
        .header { text-align: center; font-size: 20px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        td, th { border: 1px solid #000; padding: 8px; }
    </style>
</head>
<body>
    <div class="header">عقد إيجار رفوف</div>

    <p><strong>رقم العقد:</strong> {{ $contract->id }}</p>
    <p><strong>التاجر:</strong> {{ $contract->merchant->name }}</p>
    <p><strong>بداية العقد:</strong> {{ $contract->rental_start }}</p>
    <p><strong>نهاية العقد:</strong> {{ $contract->rental_end }}</p>
    <p><strong>الحالة:</strong> {{ $contract->status }}</p>
    <p><strong>المبلغ الكلي:</strong> {{ $contract->price }} ريال</p>

    <h4>الرفوف المستأجرة:</h4>
    <table>
        <thead>
            <tr>
                <th>الكود</th>
                <th>الوصف</th>
                <th>الحجم</th>
                <th>السعر</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contract->shelves as $shelf)
            <tr>
                <td>{{ $shelf->code }}</td>
                <td>{{ $shelf->description }}</td>
                <td>{{ $shelf->size }}</td>
                <td>{{ $shelf->price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
