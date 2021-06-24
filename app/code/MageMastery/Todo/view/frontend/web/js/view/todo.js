define(['uiComponent', 'jquery', 'Magento_Ui/js/modal/confirm',
    'MageMastery_Todo/js/service/task'],
    function (Component, $, modal, taskService) {
        'use strict';

        return Component.extend({
            defaults: {
                newTaskLabel: "My task",
                buttonSelector: "#add-new-task-button",
                tasks: [],
            },
            initObservable: function () {
                this._super().observe(['tasks', "newTaskLabel"]);
                var inobs = this;
                taskService.getList().then(function (tasks) {
                inobs.tasks(tasks);
                return tasks;
                });
                return this;
            },

            switchStatus: function (data, event) {
                const taskId = $(event.target).data('id');
                const items = this.tasks.map(function (task) {
                    if(task.task_id === taskId){
                        task.status = task.status === 'open' ? 'complete' : 'open';
                        return task;
                    }
                });
                this.tasks(items);
            },

            deleteTask: function (taskId) {
                let obj = this;
                modal({
                    content: 'Are you sure want to delete the task&',
                    actions: {
                        confirm: function () {
                            let tasks = [];
                            if (obj.tasks.length === 1) {
                                obj.tasks(tasks);
                                return;
                            }

                            obj.tasks().forEach(task => {
                                if (taskId !== task.task_id) tasks.push(task)
                            });
                            obj.tasks(tasks);

                        }
                    }
                });
            },

            addNTask: function () {
                this.tasks.push({id: Math.floor(Math.random() * 100), label: this.newTaskLabel(), status: true},);
                this.newTaskLabel("...")
            },

            checkKey: function (data, event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    $(this.buttonSelector).click();
                }
            },

        });
    });

