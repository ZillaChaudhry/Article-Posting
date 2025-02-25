<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/Form.css">
    <title>Submit IJLASS Form</title>
    <style>
        .tags-input-container {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 5px;
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            background-color: #fff;
        }

        .tags-input-container input {
            border: none;
            outline: none;
            flex: 1;
            padding: 5px;
        }

        .tag {
            background-color: #d1e7dd;
            border-radius: 3px;
            padding: 5px 10px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .remove-tag {
            margin-left: 5px;
            cursor: pointer;
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="card-body">
    <form method="POST" action="/controller/Dashboard/Submit_Form.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title (Max 100 characters)</label>
            <input type="text" class="form-control" name="title" placeholder="Enter Title" maxlength="100" required>
        </div>
        <div class="mb-3">
            <label for="authers" class="form-label">Authers (Max 500 characters)</label>
            <div class="tags-input-container">
                <div id="tags"></div>
                <input type="text" name="authers-input" id="authers-input" placeholder="Enter Authers (Sperate authers by Comas(,))" maxlength="500">
                <input type="hidden" name="authers" id="authers-hidden">
            </div>
        </div>
        <div class="mb-3">
            <label for="abstract" class="form-label">Abstract (Max 250 characters)</label>
            <textarea class="form-control" name="abstract" rows="3" placeholder="Write a brief abstract" maxlength="250" required></textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (Max 1000 characters)</label>
            <textarea class="form-control" name="description" rows="5" placeholder="Enter a detailed description" maxlength="1000" required></textarea>
        </div>
        <div class="mb-3">
            <label for="fileUpload" class="form-label">Upload File</label>
            <input type="file" class="form-control" name="fileUpload" accept=".pdf" required>
        </div>    
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const authersInput = document.getElementById('authers-input');
        const tagsContainer = document.getElementById('tags');
        const hiddenInput = document.getElementById('authers-hidden');

        let tags = [];

        authersInput.addEventListener('input', function () {
            const value = authersInput.value;
            if (value.includes(',')) {
                const parts = value.split(',');
                parts.forEach((part, index) => {
                    const trimmedPart = part.trim();
                    if (trimmedPart.length > 0) {
                        addTag(trimmedPart);
                    }
                    if (index === parts.length - 1 && part.trim() === "") {
                        authersInput.value = ''; // Reset input when last part is empty
                    } else {
                        authersInput.value = parts[parts.length - 1].trim(); // Keep the last part in input
                    }
                });
            }
        });

        authersInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                const value = authersInput.value.trim();
                if (value.length > 0) {
                    addTag(value);
                    authersInput.value = '';
                }
                event.preventDefault(); // Prevent newline in input
            }
        });

        function addTag(text) {
            if (!tags.includes(text)) {
                tags.push(text);
                updateHiddenInput();

                const tag = document.createElement('span');
                tag.className = 'tag';
                tag.innerText = text;

                const closeIcon = document.createElement('span');
                closeIcon.className = 'remove-tag';
                closeIcon.innerHTML = '&times;';
                closeIcon.addEventListener('click', function () {
                    removeTag(text);
                });

                tag.appendChild(closeIcon);
                tagsContainer.appendChild(tag);
            }
        }

        function removeTag(text) {
            tags = tags.filter(tag => tag !== text);
            updateHiddenInput();
            Array.from(tagsContainer.children).forEach(tagElement => {
                if (tagElement.innerText.startsWith(text)) {
                    tagsContainer.removeChild(tagElement);
                }
            });
        }

        function updateHiddenInput() {
            hiddenInput.value = tags.join(',');
        }
    });
</script>


</body>
</html>
