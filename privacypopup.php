<script>
function openPrivacyPopup() {
  var popup = document.createElement("div");
  popup.id = "privacyPopup";
  popup.style.backgroundColor = "#f5f5f5";
  popup.style.border = "1px solid #ccc";
  popup.style.borderRadius = "5px";
  popup.style.boxShadow = "0px 0px 5px #999";
  popup.style.padding = "20px";
  popup.style.position = "fixed";
  popup.style.top = "50%";
  popup.style.left = "50%";
  popup.style.transform = "translate(-50%, -50%)";
  popup.style.zIndex = "9999";

  var closeBtn = document.createElement("button");
  closeBtn.innerHTML = "Close";
  closeBtn.style.backgroundColor = "#ccc";
  closeBtn.style.border = "none";
  closeBtn.style.borderRadius = "5px";
  closeBtn.style.color = "#fff";
  closeBtn.style.cursor = "pointer";
  closeBtn.style.marginTop = "10px";
  closeBtn.style.padding = "10px 20px";

  var content = document.createElement("div");
  content.innerHTML = `
    <h2>Privacy Policy</h2>
    <p>Insert your privacy policy text here.</p>
  `;

  popup.appendChild(content);
  popup.appendChild(closeBtn);
  document.body.appendChild(popup);

  closeBtn.addEventListener("click", function() {
    document.body.removeChild(popup);
  });
}

// Call this function after the user registers with the website
openPrivacyPopup();
</script>