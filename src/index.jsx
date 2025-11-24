import { createRoot } from "react-dom/client";

const mount = () => {
    const el = document.getElementById("enspyred-theme-default");
    if (!el || el.__theme_mounted) return;
    el.__theme_mounted = true;
    createRoot(el).render(<h1>Enspyred Theme</h1>);
};

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", mount);
} else {
    mount();
}

if (import.meta.hot) {
    import.meta.hot.accept(() => mount());
}
