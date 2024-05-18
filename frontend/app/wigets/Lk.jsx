import {Tab, TabList, TabPanel, TabPanels, Tabs, Box, Button} from "@chakra-ui/react";
import {sendGet} from "@/app/util/axios";
import {useEffect, useState} from "react";
import TaskList from "@/app/components/TaskList";
import { Link } from "@chakra-ui/next-js";

export function Lk() {
    const [tasks, setTasks] = useState([]);

    useEffect(() => {
        (async () => {
            const {data} = await sendGet('tasks', true);
            setTasks(data);
        })()
    }, []);

    return (
        <>
            <Link href={"/create"}><Button colorScheme='blue'>Создать заявку</Button></Link>
            <Box display="flex" justifyContent="center">
                <Box w="55%">
                    <Tabs>
                        <TabList>
                            <Tab>Черновики</Tab>
                            <Tab>Успешный скоринг</Tab>
                            <Tab>Предложения банка</Tab>
                            <Tab>Выпуск БГ</Tab>
                            <Tab>Действующие гарантии</Tab>
                        </TabList>

                        <TabPanels>
                            <TabPanel>
                                <TaskList tasks={tasks} filter={1} />
                            </TabPanel>
                            <TabPanel>
                                <TaskList tasks={tasks} filter={2} />
                            </TabPanel>
                            <TabPanel>
                                <TaskList tasks={tasks} filter={3} />
                            </TabPanel>
                            <TabPanel>
                                <TaskList tasks={tasks} filter={4} />
                            </TabPanel>
                            <TabPanel>
                                <TaskList tasks={tasks} filter={5} />
                            </TabPanel>
                        </TabPanels>
                    </Tabs>
                </Box>
            </Box>
        </>
    );
}