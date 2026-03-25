(function () {
    var headerShell = document.querySelector(".header-shell");
    var navToggle = document.querySelector("[data-nav-toggle]");
    var nav = document.querySelector("[data-nav]");

    if (headerShell) {
        var getHeaderCompactThreshold = function () {
            return window.innerWidth <= 760 ? 70 : 16;
        };

        var syncHeaderState = function () {
            if (window.scrollY > getHeaderCompactThreshold()) {
                headerShell.classList.add("is-scrolled");
            } else {
                headerShell.classList.remove("is-scrolled");
            }
        };

        syncHeaderState();
        window.addEventListener("scroll", syncHeaderState, { passive: true });
        window.addEventListener("resize", syncHeaderState);
    }

    if (navToggle && nav) {
        navToggle.addEventListener("click", function () {
            nav.classList.toggle("is-open");
        });

        document.addEventListener("click", function (event) {
            var clickedInsideNav = nav.contains(event.target);
            var clickedToggle = navToggle.contains(event.target);
            if (!clickedInsideNav && !clickedToggle) {
                nav.classList.remove("is-open");
            }
        });

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                nav.classList.remove("is-open");
            }
        });

        nav.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
                nav.classList.remove("is-open");
            });
        });
    }

    var revealItems = document.querySelectorAll("[data-reveal]");
    if (revealItems.length > 0 && "IntersectionObserver" in window) {
        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("visible");
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15 }
        );

        revealItems.forEach(function (item, index) {
            item.style.transitionDelay = Math.min(index * 40, 240) + "ms";
            observer.observe(item);
        });
    } else {
        revealItems.forEach(function (item) {
            item.classList.add("visible");
        });
    }

    var counters = document.querySelectorAll("[data-count-up]");
    if (counters.length > 0) {
        var runCounter = function (counter) {
            if (counter.dataset.counted === "true") {
                return;
            }

            var target = Number(counter.getAttribute("data-target") || "0");
            var prefix = counter.getAttribute("data-prefix") || "";
            var suffix = counter.getAttribute("data-suffix") || "";
            var decimals = Number(counter.getAttribute("data-decimals") || "0");
            var useThousands = counter.hasAttribute("data-thousands");
            var duration = 1400;
            var startTime = null;

            counter.dataset.counted = "true";

            var step = function (timestamp) {
                if (!startTime) {
                    startTime = timestamp;
                }

                var progress = Math.min((timestamp - startTime) / duration, 1);
                var eased = 1 - Math.pow(1 - progress, 3);
                var rawValue = target * eased;
                var displayValue = decimals > 0 ? Number(rawValue.toFixed(decimals)) : Math.round(rawValue);
                var valueText = decimals > 0 ? displayValue.toFixed(decimals) : String(displayValue);

                if (useThousands) {
                    valueText = Number(valueText).toLocaleString(undefined, {
                        minimumFractionDigits: decimals,
                        maximumFractionDigits: decimals,
                    });
                }

                counter.textContent = prefix + valueText + suffix;

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };

            window.requestAnimationFrame(step);
        };

        if ("IntersectionObserver" in window) {
            var counterObserver = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            runCounter(entry.target);
                            counterObserver.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.4 }
            );

            counters.forEach(function (counter) {
                counterObserver.observe(counter);
            });
        } else {
            counters.forEach(runCounter);
        }
    }

    var floatingSearch = document.querySelector("[data-floating-search]");
    if (floatingSearch) {
        var lastScrollY = window.scrollY;
        var minVisibleScroll = 220;

        var syncFloatingSearch = function () {
            var currentScrollY = window.scrollY;
            var isScrollingDown = currentScrollY > lastScrollY + 4;
            var isScrollingUp = currentScrollY < lastScrollY - 4;

            if (currentScrollY < minVisibleScroll) {
                floatingSearch.classList.remove("is-visible");
            } else if (isScrollingDown) {
                floatingSearch.classList.add("is-visible");
            } else if (isScrollingUp) {
                floatingSearch.classList.remove("is-visible");
            }

            lastScrollY = currentScrollY;
        };

        syncFloatingSearch();
        window.addEventListener("scroll", syncFloatingSearch, { passive: true });
    }

    var scrollTopButton = document.querySelector("[data-scroll-top]");
    if (scrollTopButton) {
        var syncScrollTopVisibility = function () {
            if (window.scrollY > 340) {
                scrollTopButton.classList.add("is-visible");
            } else {
                scrollTopButton.classList.remove("is-visible");
            }
        };

        scrollTopButton.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });

        syncScrollTopVisibility();
        window.addEventListener("scroll", syncScrollTopVisibility, { passive: true });
    }

    var productCards = document.querySelectorAll("[data-product-url]");
    if (productCards.length > 0) {
        var isInteractiveElement = function (target) {
            return !!target.closest("a, button, input, select, textarea, label");
        };

        productCards.forEach(function (card) {
            var url = card.getAttribute("data-product-url");
            if (!url) {
                return;
            }

            card.addEventListener("click", function (event) {
                if (isInteractiveElement(event.target)) {
                    return;
                }
                window.location.href = url;
            });

            card.addEventListener("keydown", function (event) {
                if (event.key === "Enter" || event.key === " ") {
                    event.preventDefault();
                    window.location.href = url;
                }
            });
        });
    }

    var smartFilterForm = document.querySelector("[data-smart-filters]");
    if (smartFilterForm) {
        var budgetRange = smartFilterForm.querySelector("[data-budget-range]");
        var budgetValue = smartFilterForm.querySelector("[data-budget-value]");

        var syncBudgetView = function () {
            if (!budgetRange || !budgetValue) {
                return;
            }

            var min = Number(budgetRange.min || "0");
            var max = Number(budgetRange.max || "100");
            var value = Number(budgetRange.value || "0");
            var progress = max > min ? ((value - min) / (max - min)) * 100 : 100;

            budgetRange.style.setProperty("--range-progress", progress.toFixed(2) + "%");
            budgetValue.textContent = "$" + value.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        };

        if (budgetRange) {
            syncBudgetView();
            budgetRange.addEventListener("input", syncBudgetView);
            budgetRange.addEventListener("change", function () {
                smartFilterForm.submit();
            });
        }

        var liveFilterFields = smartFilterForm.querySelectorAll("[data-filter-live]");
        liveFilterFields.forEach(function (field) {
            field.addEventListener("change", function () {
                smartFilterForm.submit();
            });
        });
    }

    var autoSubmitFields = document.querySelectorAll("[data-auto-submit]");
    autoSubmitFields.forEach(function (field) {
        field.addEventListener("change", function () {
            if (field.form) {
                field.form.submit();
            }
        });
    });

    var appointmentTriggers = document.querySelectorAll("[data-appointment-open]");
    var appointmentModal = document.querySelector("[data-appointment-modal]");
    var appointmentCloseButtons = document.querySelectorAll("[data-appointment-close]");
    var appointmentForm = document.querySelector("[data-appointment-form]");
    var appointmentStatus = document.querySelector("[data-appointment-status]");

    if (appointmentTriggers.length > 0 && appointmentModal) {
        var closeAppointmentModal = function () {
            appointmentModal.hidden = true;
            document.body.classList.remove("policy-modal-open");
        };

        var openAppointmentModal = function () {
            appointmentModal.hidden = false;
            document.body.classList.add("policy-modal-open");

            if (appointmentStatus) {
                appointmentStatus.hidden = true;
            }
        };

        appointmentTriggers.forEach(function (trigger) {
            trigger.addEventListener("click", function (event) {
                event.preventDefault();
                openAppointmentModal();
            });
        });

        appointmentCloseButtons.forEach(function (button) {
            button.addEventListener("click", closeAppointmentModal);
        });

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape" && !appointmentModal.hidden) {
                closeAppointmentModal();
            }
        });

        if (appointmentForm) {
            appointmentForm.addEventListener("submit", function (event) {
                event.preventDefault();

                if (appointmentStatus) {
                    appointmentStatus.hidden = false;
                }

                appointmentForm.reset();
            });
        }
    }

    var escapeHtml = function (value) {
        return value
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;");
    };

    var setupPolicyModal = function (config) {
        var trigger = document.querySelector(config.triggerSelector);
        var modal = document.querySelector(config.modalSelector);
        var content = document.querySelector(config.contentSelector);
        var loaded = false;

        if (!trigger || !modal || !content) {
            return;
        }

        var closeButtons = modal.querySelectorAll(config.closeSelector);
        var printButton = modal.querySelector(config.printSelector);

        var closeModal = function () {
            modal.hidden = true;
            document.body.classList.remove("policy-modal-open");
        };

        var openModal = function () {
            modal.hidden = false;
            document.body.classList.add("policy-modal-open");

            if (!loaded) {
                fetch(config.contentUrl)
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error("Failed to load policy content");
                        }
                        return response.text();
                    })
                    .then(function (text) {
                        content.textContent = text;
                        loaded = true;
                    })
                    .catch(function () {
                        content.textContent = config.loadErrorText;
                    });
            }
        };

        trigger.addEventListener("click", openModal);

        closeButtons.forEach(function (button) {
            button.addEventListener("click", closeModal);
        });

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape" && !modal.hidden) {
                closeModal();
            }
        });

        if (printButton) {
            printButton.addEventListener("click", function () {
                var printWindow = window.open("", "_blank", "width=900,height=700");
                if (!printWindow) {
                    return;
                }

                printWindow.document.write(
                    "<!doctype html><html><head><title>" +
                        escapeHtml(config.printTitle) +
                        "</title><style>body{font-family:Inter,Segoe UI,sans-serif;padding:32px;color:#0f172a;line-height:1.65;}pre{white-space:pre-wrap;font:14px/1.7 Inter,Segoe UI,sans-serif;}</style></head><body><pre>" +
                        escapeHtml(content.textContent) +
                        "</pre></body></html>"
                );
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
            });
        }
    };

    setupPolicyModal({
        triggerSelector: "[data-policy-open]",
        modalSelector: "[data-policy-modal]",
        contentSelector: "[data-policy-content]",
        closeSelector: "[data-policy-close]",
        printSelector: "[data-policy-print]",
        contentUrl: "includes/privacy-policy-content.txt",
        loadErrorText: "Privacy Policy content could not be loaded.",
        printTitle: "Privacy Policy",
    });

    setupPolicyModal({
        triggerSelector: "[data-refund-open]",
        modalSelector: "[data-refund-modal]",
        contentSelector: "[data-refund-content]",
        closeSelector: "[data-refund-close]",
        printSelector: "[data-refund-print]",
        contentUrl: "includes/refund-policy-content.txt",
        loadErrorText: "Refund Policy content could not be loaded.",
        printTitle: "Refund Policy",
    });

    setupPolicyModal({
        triggerSelector: "[data-shipping-open]",
        modalSelector: "[data-shipping-modal]",
        contentSelector: "[data-shipping-content]",
        closeSelector: "[data-shipping-close]",
        printSelector: "[data-shipping-print]",
        contentUrl: "includes/shipping-policy-content.txt",
        loadErrorText: "Shipping Policy content could not be loaded.",
        printTitle: "Shipping Policy",
    });

    setupPolicyModal({
        triggerSelector: "[data-terms-open]",
        modalSelector: "[data-terms-modal]",
        contentSelector: "[data-terms-content]",
        closeSelector: "[data-terms-close]",
        printSelector: "[data-terms-print]",
        contentUrl: "includes/terms-conditions-content.txt",
        loadErrorText: "Terms and Conditions content could not be loaded.",
        printTitle: "Terms and Conditions",
    });
})();
