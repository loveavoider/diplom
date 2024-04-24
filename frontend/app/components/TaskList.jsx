'use client';

import {useEffect, useState} from "react";
import {sendRequest} from "@/app/util/axios";
import {Box} from "@chakra-ui/react";
import Task from "@/app/components/Task";

export default function TaskList() {
    const [tasks, setTasks] = useState([]);

    useEffect(() => {
        const getTasks = async () => {
            const { data } = await sendRequest('get', {}, 'tasks', true);
            setTasks(data)
        };
        getTasks()
    }, []);

    return (
        <Box>
            {tasks.map(task => {
                <Task title={task.title} />
            })}
        </Box>
    )
}