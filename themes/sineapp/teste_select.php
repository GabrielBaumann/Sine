<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>

    <!-- CBO - Ocupação -->
    <div>
        <label for="cbo-occupation" class="block text-sm font-medium text-gray-700 mb-1">CBO - Ocupação *</label>
        <select
            hidden
            id="cbo-occupation" 
            name="cbo-occupation"
            class="bg-white block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
            <option value="">CBO ocupação</option>
            <?php foreach($cbos_occupations as $cbo_occupation): ?>
                <option value="<?= $cbo_occupation->id_code; ?>" <?= ($vacancy->cbo_occupation ?? null) === "{$cbo_occupation->id_code}" ? "selected" : "" ?>><?= $cbo_occupation->id_code; ?> - <?= $cbo_occupation->occupation; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="<?= theme("/assets/js/vacancy/page.js", CONF_VIEW_APP); ?>"></script>
</body>
</html>