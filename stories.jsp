<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="java.io.File" %>
<%@ page import="java.util.List" %>
<%@ page import="org.apache.commons.fileupload.FileItem" %>
<%@ page import="org.apache.commons.fileupload.disk.DiskFileItemFactory" %>
<%@ page import="org.apache.commons.fileupload.servlet.ServletFileUpload" %>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Submission Result</title>
    <link rel="stylesheet" href="styles/css/main.css">
</head>

<body>
    <header>
        <div class="container">
            <h2>Story Submission Result</h2>
        </div>
    </header>

    <main>
        <section class="content">
            <%
                // Define directory to save uploaded files
                String uploadPath = application.getRealPath("/") + "uploads";
                File uploadDir = new File(uploadPath);
                if (!uploadDir.exists()) uploadDir.mkdir();

                // Check if form is multipart
                if (ServletFileUpload.isMultipartContent(request)) {
                    DiskFileItemFactory factory = new DiskFileItemFactory();
                    ServletFileUpload upload = new ServletFileUpload(factory);
                    String storyTitle = "";
                    String storyGenre = "";
                    String storyContent = "";
                    String fileName = "";

                    try {
                        List<FileItem> formItems = upload.parseRequest(request);
                        for (FileItem item : formItems) {
                            if (item.isFormField()) {
                                // Process regular form fields
                                switch (item.getFieldName()) {
                                    case "storyTitle":
                                        storyTitle = item.getString();
                                        break;
                                    case "storyGenre":
                                        storyGenre = item.getString();
                                        break;
                                    case "storyContent":
                                        storyContent = item.getString();
                                        break;
                                }
                            } else {
                                // Process file field
                                fileName = new File(item.getName()).getName();
                                String filePath = uploadPath + File.separator + fileName;
                                File storeFile = new File(filePath);
                                item.write(storeFile);
                            }
                        }
                        
                        // Display submitted data
                        out.println("<h3>Submitted Story</h3>");
                        out.println("<p><strong>Title:</strong> " + storyTitle + "</p>");
                        out.println("<p><strong>Genre:</strong> " + storyGenre + "</p>");
                        out.println("<p><strong>Content:</strong> " + storyContent + "</p>");
                        out.println("<p><strong>Photo:</strong><br><img src='uploads/" + fileName + "' width='200'></p>");
                        
                    } catch (Exception ex) {
                        out.println("<p>There was an error: " + ex.getMessage() + "</p>");
                    }
                } else {
                    out.println("<p>Error: Form must have enctype='multipart/form-data'.</p>");
                }
            %>
        </section>
    </main>
</body>

</html>
