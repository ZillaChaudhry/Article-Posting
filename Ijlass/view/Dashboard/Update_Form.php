<style>
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
</style>

<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Fetch the article data for the form
    $query = "SELECT id,title, abstract, description,authers,file FROM tbl_form WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Extract the file name from the file path
        $fileName = basename($row['file']);
    } else {
        echo "Article not found.";
        exit;
    }
} else {
    echo "Invalid article ID.";
    exit;
}
?>

<div class="card-body">
    <form method="POST" action="/controller/Dashboard/Update_Form.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title (Max 100 characters)</label>
            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" maxlength="100" required>
        </div>

        
        <div class="mb-3">
    <label for="authers" class="form-label">Authors (Max 500 characters)</label>
    <div class="tags-input-container">
        <div id="tags"></div>
        <input 
            class="form-control"
            type="text" 
            name="authers-input" 
            id="authers-input" 
            placeholder="Enter Authors (Separate authors by commas (,))">
            <input 
    type="hidden" 
    name="authers" 
    id="authers-hidden" 
    value="<?php echo isset($row['authers']) ? htmlspecialchars($row['authers']) : ''; ?>">

    </div>
</div>
        <div class="mb-3">
            <label for="abstract" class="form-label">Abstract (Max 250 characters)</label>
            <textarea class="form-control" name="abstract" rows="3" maxlength="250" required><?php echo htmlspecialchars($row['abstract']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (Max 1000 characters)</label>
            <textarea class="form-control" name="description" rows="5" maxlength="1000" required><?php echo htmlspecialchars($row['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="fileUpload" class="form-label">Upload File</label>
            <input type="file" class="form-control" name="fileUpload" accept=".pdf">
            <?php if (!empty($fileName)) { ?>
                <p style="font-weight: bold; color: #007bff; font-size: 16px; margin-top: 10px;">
                    Current file:   <span><?php echo htmlspecialchars($fileName); ?></span>
                </p>
            <?php } ?>
            <!-- Hidden field to store the file path -->
            <input type="hidden" name="currentFile" value="<?php echo htmlspecialchars($row['file']); ?>">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const authersInput = document.getElementById('authers-input');
        const tagsContainer = document.getElementById('tags');
        const hiddenInput = document.getElementById('authers-hidden');

        let tags = [];

        // Initialize tags from hidden input
        const initialTags = hiddenInput.value.split(',').map(tag => tag.trim()).filter(tag => tag !== "");
        initialTags.forEach(tag => addTag(tag));

        authersInput.addEventListener('keyup', function (event) {
            if (event.key === ',' || event.key === 'Enter') {
                const value = authersInput.value.trim().replace(/,$/, '');
                if (value.length > 0) {
                    addTag(value);
                    authersInput.value = '';
                }
                event.preventDefault(); // Prevent adding comma in input
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